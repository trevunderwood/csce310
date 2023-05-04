<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csce310";

$conn = mysqli_connect($servername, $username, $password, $dbname); //connect to database

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { //if form is completed

  $username = $_POST["username"]; //get username from form
  $password = $_POST["password"]; //get password from form

  $sql = "SELECT * FROM USER WHERE USER_NAME = '$username'"; //get from user based on username to see if username is in there
  $result = mysqli_query($conn, $sql); //execute query

  if (mysqli_num_rows($result) == 1) { //if there is a user, log in

    session_start();
    $_SESSION["username"] = $username; //store username
    header("Location: user_profile.php"); //reroute to home page
  } else {
    
    echo "Invalid username or password"; //user does not exist
  }
}

mysqli_close($conn);
?>
