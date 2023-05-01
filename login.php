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

// Check if the login form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Get the input values from the form
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Query the database to check if the user exists
  $sql = "SELECT * FROM USER WHERE USER_NAME = '$username'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) == 1) {
    // User exists, log them in
    echo "Success";
    // session_start();
    // $_SESSION["username"] = $username;
    header("Location: user_profile.php");
  } else {
    // User does not exist or password is incorrect
    echo "Invalid username or password";
  }
}

mysqli_close($conn);
?>
