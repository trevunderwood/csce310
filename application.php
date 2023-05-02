<!DOCTYPE html>
<html>
<head>
	<title>Applications</title>
</head>
<body>
<ul>
    <li><a href="posting.php">Postings</a></li>
    <li><a href="appointments.php">Appointments</a></li>
    <li><a href="user_profile.php">Profile</a></li>
    <li><a href="login.html">Logout</a></li>
</ul>
</body>
<table align = "left" border = "1" cellpadding = "3" cellspacing = "0">
    <tr>
        <td>
            COMPANY
        </td>
        <td>
            Job Title
        </td>
        <td>    
        </td>


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

$sql = "SELECT APPLICANT_ID FROM APPLICANT WHERE USER_NAME = '$user'";

$result = $conn->query($sql);

$id = $result->fetch_assoc();

// $sql = "CREATE VIEW DETAILS AS SELECT APPLICATIONS.APPLICATION_ID, APPLICATIONS.APPLICANT_ID, APPLICATIONS.POST_ID, JOB_POSTING.POST_DESC, COMPANY.COMPANY_NAME FROM APPLICATIONS, JOB_POSTING, COMPANY WHERE APPLICATIONS.POST_ID = JOB_POSTING.POST_ID AND JOB_POSTING.COMPANY_ID = COMPANY.COMPANY_ID";

// $result = $conn->query($sql);

$sql = "SELECT * FROM DETAILS WHERE APPLICANT_ID = " . $id["APPLICANT_ID"];

$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>". $row["COMPANY_NAME"] . "</td>";
        echo "<td>". $row["POST_DESC"] . "</td>";
        echo "<td><a href = 'edit_application.php?APPLICATION_ID=" .$row["APPLICATION_ID"] . "&COMPANY_NAME=" .urlencode($row["COMPANY_NAME"]) ."&POST_DESC=" .$row["POST_DESC"] ."'>Edit Application</a></td>";
        echo "</tr>";

        
    }
}
?>

</html>