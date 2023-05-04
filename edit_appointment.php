<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csce310";

$conn = mysqli_connect($servername, $username, $password, $dbname); //connect to database

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { //if form has been submitted


  $appt_id = $_POST["appt_id"]; //get appt_id from form
  $appt_time = $_POST["appt_time"]; //get appt_time from form
  $applicant_id = $_POST["applicant_id"]; //get applicant_id from form
  $recruiter_id = $_POST["recruiter_id"]; //get recruiter_id from form


  $sql = "UPDATE appointments SET APPT_TIME='$appt_time', APPLICANT_ID='$applicant_id', RECRUITER_ID='$recruiter_id' WHERE APPT_ID='$appt_id'"; //update appointment for appt_id
  $result = mysqli_query($conn, $sql); //run query

  if ($result) { //if successful
    header("Location: appointments.php"); //redirect back to appointments page
  } else {
    // There was an error updating the appointment in the database
    echo "Error: " . mysqli_error($conn);
  }
}


$appt_id = $_GET["APPT_ID"]; //get appt_id from url


$sql = "SELECT * FROM appointments WHERE APPT_ID=$appt_id"; //get all appointments from database for appt_id
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) { //display form
 
  $row = mysqli_fetch_assoc($result); //each row
  $appt_time = $row["appt_time"]; //appt_time
  $applicant_id = $row["applicant_id"]; //applicant_id
  $recruiter_id = $row["recruiter_id"]; //recruiter_id

  //FORM
  echo "<h2>Edit Appointment</h2>";
  echo "<form method='post'>";
  echo "<input type='hidden' name='appt_id' value='$appt_id'>";
  echo "Time of Appointment: <input type='text' name='appt_time' value='$appt_time'><br><br>";
  echo "Applicant ID: <input type='text' name='applicant_id' value='$applicant_id'><br><br>";
  echo "Recruiter ID: <input type='text' name='recruiter_id' value='$recruiter_id'><br><br>";
  echo "<input type='submit' value='Update Appointment'>";
  echo "</form>";
} else {
  // Display an error message if the appointment is not found in the database
  echo "Appointment not found.";
}

mysqli_close($conn);
?>
