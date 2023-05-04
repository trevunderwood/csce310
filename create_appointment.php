<?php
// Trevor Underwood wrote this file. This code manages the create appointment page to create an appointment.

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csce310";

$conn = mysqli_connect($servername, $username, $password, $dbname); //connect to database

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { //if form has been submitted

  $appt_time = $_POST["appt_time"]; //appt_id from form
  $applicant_id = $_POST["applicant_id"]; //applicant_id from form
  $recruiter_id = $_POST["recruiter_id"]; //post_id from form



  $sql = "INSERT INTO appointments (APPT_TIME, APPLICANT_ID, RECRUITER_ID)
VALUES ('$appt_time', '$applicant_id', '$recruiter_id')"; //insert new appointment into appointments
  $result = mysqli_query($conn, $sql); //run query
    //echo "result run";
  if ($result) { //if successful
    echo "added appointment"; 
    header("Location: appointments.php"); //reroute back to appointments page
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