<?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csce310";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the user registration form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Get the input values from the form
  //$appt_id = $_POST["appt_id"];
  $appt_time = $_POST["appt_time"];
  $applicant_id = $_POST["applicant_id"];
  $recruiter_id = $_POST["recruiter_id"];



  // Insert the new user into the database
  $sql = "INSERT INTO appointments (APPT_TIME, APPLICANT_ID, RECRUITER_ID)
VALUES ('$appt_time', '$applicant_id', '$recruiter_id')";
  $result = mysqli_query($conn, $sql);
    //echo "result run";
  if ($result) {
    // User was added successfully, redirect to the login page
    echo "added appointment";
    //header("Location: appointments.php");
  } else {
    // There was an error adding the user to the database
    echo "Error: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Appointment Page</title>
</head>
<body>
	<h2>Create a New Appointment</h2>
	<form method="post" action="create_appointment.php">
    <label> Timestamp:</label>
        <input type="text" name="appt_time" required>
		<br>
		<label>Applicant ID:</label>
		<input type="text" name="applicant_id" required>
		<br>
		<label>Recruiter ID:</label>
		<input type="text" name="recruiter_id" required>
		<br>

		<input type="submit" value="Create Appointment">
	</form>
</body>
</html>