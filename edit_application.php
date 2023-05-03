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

  $appid = $_POST["appid"];

  // Get the input values from the form
  $postid = $_POST["postid"];
  
  $sql = "SELECT APPLICANT_ID FROM APPLICANT WHERE USER_NAME = '$user'";

  $result = $conn->query($sql);

  $id = $result->fetch_assoc();

  $date = date('Y-m-d h:i:s');

  // Insert the new application into the database

  echo $postid;

  $sql = "UPDATE APPLICATIONS SET POST_ID = '$postid', SUBMISSION_DATE = '$date' WHERE APPLICATION_ID = '$appid'";
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
//Display information related to appointment to be updated
if(isset($_GET["APPLICATION_ID"])){
  $company = urldecode($_GET["COMPANY_NAME"]);
  $appid = $_GET["APPLICATION_ID"];
  $postDesc = $_GET["POST_DESC"];
  echo "<h2>Edit Application</h2>";
  echo "<form method='post' action='edit_application.php'>";
  echo "<label>Company:</label>";
  echo $company;
  echo "<br>";
  echo "<input type='hidden' name='appid' value='$appid'>";
  echo "<label>Current Job Title:</label>";
  echo $postDesc;
  echo "<br>";
  echo "Input Post ID of New Job Position";
  echo "<br>";
  echo "<input type ='text' name='postid'";
  echo "<br>";
  echo "<input type='submit' value='Update Application'>";
  echo "</form>";
  echo "<br>";
  $sql = "SELECT COMPANY_ID FROM COMPANY WHERE COMPANY_NAME = '$company'";
  $result = $conn->query(($sql));
  $compid = $result->fetch_assoc();
  $sql = "SELECT * FROM JOB_POSTING WHERE COMPANY_ID = " . $compid["COMPANY_ID"];
  $result = $conn->query(($sql));

  if($result->num_rows > 0){
    echo "Other Job Listings Available";
    echo "<br>";
    echo "<table align = 'left' border = '1' cellpadding = '3' cellspacing = '0'>";
    echo "<tr>";
    echo "<td>Post ID</td><td>Job Title</td>";
    echo "</tr>";
    while($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>" . $row["POST_ID"] . "</td>";
        echo "<td>" . $row["POST_DESC"] . "</td>";
        echo "</tr>";
    }
  }
}


mysqli_close($conn);
?>