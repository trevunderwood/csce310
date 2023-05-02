<!DOCTYPE html>
<html>
<head>
	<title>Edit Application</title>
</head>
<body>
<ul>
    <li><a href="posting.php">Postings</a></li>
    <li><a href="appointments.php">Appointments</a></li>
    <li><a href="user_profile.php">Profile</a></li>
    <li><a href="login.html">Logout</a></li>
</ul>
</body>
</html>

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
  $postid = $_POST["postid"];
  
  $sql = "SELECT APPLICANT_ID FROM APPLICANT WHERE USER_NAME = '$user'";

  $result = $conn->query($sql);

  $id = $result->fetch_assoc();

  $date = date('Y-m-d h:i:s');

  // Insert the new application into the database

  $sql = "INSERT INTO APPLICATIONS (APPLICANT_ID, POST_ID, SUBMISSION_DATE) VALUES ('$id[APPLICANT_ID]', '$postid', '$date')";
  $result = mysqli_query($conn, $sql);
    //echo "result run";
  if ($result) {
    // User was added successfully, redirect to the login page
    echo "added application";
    header("Location: posting.php");
  } else {
    // There was an error adding the user to the database
    echo "Error: " . mysqli_error($conn);
  }
}
if(isset($_GET["APPLICATION_ID"])){
  $company = urldecode($_GET["COMPANY_NAME"]);
  $appid = $_GET["APPLICATION_ID"];
  $postDesc = $_GET["POST_DESC"];
  echo "<h2>Edit Application</h2>";
  echo "<form method='post' action='edit_application.php'>";
  echo "<label>Company:</label>";
  echo $company;
  echo "<br>";
  echo "<input type='hidden' name='postid' value='$appid'>";
  echo "<label>Job Title:</label>";
  echo $postDesc;
  echo "<br>";
  echo "<input type='submit' value='Update Application'>";
  echo "</form>";
}


mysqli_close($conn);
?>