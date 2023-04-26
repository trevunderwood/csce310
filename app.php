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
  $username = $_POST["username"];

  $sql = "SELECT APPLICANT_ID from APPLICANT where USER_NAME = " . $username;

  $result = conn->query($sql);

  $id = $result->fetch_assoc();
  $date = date('Y-m-d H:i:s');
  // Insert the new user into the database
  $sql = "INSERT INTO APPLICATIONS (APPLICANT_ID, )
VALUES ('$username')";
  $result = mysqli_query($conn, $sql);
    //echo "result run";
  if ($result) {
    // User was added successfully, redirect to the login page
    echo "added user";
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
	<title>Create User Page</title>
</head>
<body>
	<h2>Create a New User Account</h2>
	<form method="post" action="create_user.php">
		<label>Username:</label>
		<input type="text" name="username" required>
		<br>
		<input type="submit" value="Create Account">
	</form>
</body>
</html>