<HTML>
<!-- Trevor Underwood wrote this file. This code manages the appointments page to print out from those tables and have links to create, delete, and update -->
<html> 
 <title>Appointments</title> 
 <body>
 <ul> 
    <li><a href="posting.php">Postings</a></li>
    <li><a href="appointments.php">Appointments</a></li>
    <li><a href="user_profile.php">Profile</a></li>
    <li><a href="login.html">Logout</a></li>
</ul>
 <h1>Appointments Page</h1>
 <?php

$conn = mysqli_connect("localhost", "root", "", "csce310"); //set up database connection

//$sql = "CREATE INDEX idx_recruiter_id on appointments (RECRUITER_ID)"; //SQL STATEMENT TO CREATE INDEX

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
session_start();
$user = $_SESSION['username']; //store username

$sql = "SELECT USER_TYPE FROM user WHERE USER_NAME = '$user'"; //get user type
$result = $conn->query($sql);
$type = $result->fetch_assoc();

if($type['USER_TYPE'] == "Applicant"){ //if user is applicant (not admin)
 
$sql = "SELECT APPLICANT_ID FROM APPLICANT WHERE USER_NAME = '$user'"; //get applicant_id for user
$result = $conn->query($sql);
$app_id = $result->fetch_assoc();

echo "Your APPLICANT_ID: " .$app_id["APPLICANT_ID"] . "<br>";

$sql = "SELECT * FROM appointments WHERE APPLICANT_ID = " . $app_id["APPLICANT_ID"]; //get all appointments under applicant_id

$result = $conn->query($sql);

if ($result->num_rows > 0) { //print out in a table
    // start table
    echo "<table style='border-collapse: collapse;'>";
    echo "<tr style='text-align: center;'><th style='border: 1px solid black;'>APPT_ID</th><th style='border: 1px solid black;'>APPT_TIME</th><th style='border: 1px solid black;'>APPLICANT_ID</th><th style='border: 1px solid black;'>RECRUITER_ID</th></tr>";
  
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr style='text-align: center;'><td style='border: 1px solid black;'>".$row["APPT_ID"]."</td><td style='border: 1px solid black;'>".$row["APPT_TIME"]."</td><td style='border: 1px solid black;'>".$row["APPLICANT_ID"]."</td><td style='border: 1px solid black;'>".$row["RECRUITER_ID"]."</td> ". "<td><a href='edit_appointment.php?APPT_ID=" . $row['APPT_ID'] . "'>Edit Appointment</a></td>" .  "<td><a href='delete_appointment.php?APPT_ID=" . $row['APPT_ID'] . "'>Delete Appointment</a></td>" . "</tr>";
    }
  
    // end table
    echo "</table>";
  } else {
    echo "0 results";
  }



$conn->close();
?>
<a href="create_appointment.php">Create Appointment</a> 

<?php
  $conn = mysqli_connect("localhost", "root", "", "csce310"); //set up database connection
  #$sql = "SELECT * FROM COMPANY"
  #mysqli_query($conn, $sql);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
  
  //$sql = "CREATE VIEW APPLICANT_TIME AS SELECT APPT_TIME, APPLICANT_ID FROM appointments"; //SQL STATEMENT TO CREATE VIEW

  
  $sql = "SELECT * FROM APPLICANT_TIME WHERE APPLICANT_ID = " . $app_id["APPLICANT_ID"]; //SQL STATEMENT TO PRINT VIEW (just for Applicants)
  
  $result = $conn->query($sql);
  echo "<br><br>";
  echo "<br>" . "VIEW JUST YOUR APPLICATIONS AND APPOINTMENT TIMES BELOW:";
  if ($result->num_rows > 0) { //print  out view table
    // start table
    echo "<table style='border-collapse: collapse;'>";
    echo "<tr style='text-align: center;'><th style='border: 1px solid black;'>APPT_TIME</th><th style='border: 1px solid black;'>APPLICANT_ID</th></tr>";
  
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr style='text-align: center;'><td style='border: 1px solid black;'>".$row["APPT_TIME"]."</td><td style='border: 1px solid black;'>".$row["APPLICANT_ID"]."</td><td style='border: 1px solid black;'>"."</tr>";
    }
  
    // end table
    echo "</table>";
  } else {
    echo "0 results";
  }

}

if($type["USER_TYPE"] == "Recruiter"){ //if user is a Recruiter (admin)
  $sql = "SELECT RECRUITER_ID FROM RECRUITER WHERE USER_NAME = '$user'"; //get user_id from username
  $result = $conn->query($sql);
  $recruit_id = $result->fetch_assoc();
  echo "Your RECRUITER_ID: " .$recruit_id["RECRUITER_ID"] . "<br>";
  $sql = "SELECT * FROM appointments WHERE RECRUITER_ID = " . $recruit_id["RECRUITER_ID"]; //select all appointments for recruiter_id
  
  $result = $conn->query($sql); //run query
  
  if ($result->num_rows > 0) { //print table
      // start table
      echo "<table style='border-collapse: collapse;'>";
      echo "<tr style='text-align: center;'><th style='border: 1px solid black;'>APPT_ID</th><th style='border: 1px solid black;'>APPT_TIME</th><th style='border: 1px solid black;'>APPLICANT_ID</th><th style='border: 1px solid black;'>RECRUITER_ID</th></tr>";
    
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr style='text-align: center;'><td style='border: 1px solid black;'>".$row["APPT_ID"]."</td><td style='border: 1px solid black;'>".$row["APPT_TIME"]."</td><td style='border: 1px solid black;'>".$row["APPLICANT_ID"]."</td><td style='border: 1px solid black;'>".$row["RECRUITER_ID"]."</td> ". "<td><a href='edit_appointment.php?APPT_ID=" . $row['APPT_ID'] . "'>Edit Appointment</a></td>" .  "<td><a href='delete_appointment.php?APPT_ID=" . $row['APPT_ID'] . "'>Delete Appointment</a></td>" . "</tr>";
      }
    
      // end table
      echo "</table>";
    } else {
      echo "0 results";
    }

}
  
?>
 <a href="create_appointment.php">Create Appointment</a>
 </body>
 </html>
