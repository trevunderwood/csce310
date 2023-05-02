<?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csce310";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

session_start();
$user = $_SESSION['username'];

// Check if the user registration form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Get the input values from the form
  $company = $_POST["company"];
  $title = $_POST["title"];
  
  $sql = "SELECT APPLICANT_ID FROM APPLICANT WHERE USER_NAME = '$user'";

  $result = $conn->query($sql);

  $id = $result->fetch_assoc();

  $sql = "SELECT POST_ID from JOB_POSTING where POST_DESC = '$title'";

  $result = $conn->query($sql);

  $postid= $result->fetch_assoc();

  $date = date('Y-m-d h:i:s');

  // Insert the new application into the database

  $sql = "INSERT INTO APPLICATIONS (APPLICANT_ID, POST_ID, SUBMISSION_DATE) VALUES ('$id[APPLICANT_ID]', '$postid[POST_ID]', '$date')";
  $result = mysqli_query($conn, $sql);
    //echo "result run";
  if ($result) {
    // User was added successfully, redirect to the login page
    echo "added application";
    //header("Location: login.html");
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
	<title>New Application</title>
</head>
<body>
	<h2>Create a New Application</h2>
	<form method="post" action="app.php">
        <label>Company:</label>
		<input type="text" name="company" required>
        <br>
        <label>Job Title:</label>
		<input type="text" name="title" required>
        <br>
		<input type="submit" value="Create Application">
	</form>
</body>
</html>