<!DOCTYPE html>
<html>
<head>
	<title>New Application</title>
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

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csce310";

//initiate connection
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
$user = $_SESSION['username'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $postdesc = $_POST["postdesc"];

    $compid = $_POST["compid"];

    $sql = "INSERT INTO JOB_POSTING (COMPANY_ID, POST_DESC) VALUES ($compid, '$postdesc')";

    $result = $conn->query($sql);

    if($result){
        header("Location: posting.php");
    }

}

if(isset($_GET["COMPANY_ID"])){
    $compid = $_GET["COMPANY_ID"];
    echo "<form method='post' action='create_post.php'>";
    echo "<input type='hidden' name='compid' value='$compid'";
    echo "<br>";
    echo "<label>Enter Job Title</label>";
    echo "<input type='text' name='postdesc'>";
    echo "<br>";
    echo "<input type='submit' value='Create Job Posting'>";
    echo "</form>";
}

?>