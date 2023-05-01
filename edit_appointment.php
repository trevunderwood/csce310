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

// Check if the appointment form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Get the input values from the form
  $appt_id = $_POST["appt_id"];
  $appt_time = $_POST["appt_time"];
  $applicant_id = $_POST["applicant_id"];
  $recruiter_id = $_POST["recruiter_id"];

  // Update the appointment in the database
  $sql = "UPDATE appointments SET APPT_TIME='$appt_time', APPLICANT_ID='$applicant_id', RECRUITER_ID='$recruiter_id' WHERE APPT_ID='$appt_id'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    // Appointment was updated successfully, redirect to the appointments page
    header("Location: appointments.php");
  } else {
    // There was an error updating the appointment in the database
    echo "Error: " . mysqli_error($conn);
  }
}

// Get the appointment_id value from the URL
$appt_id = $_GET["APPT_ID"];

// Retrieve the appointment from the database
$sql = "SELECT * FROM appointments WHERE APPT_ID=$appt_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // Display the appointment form with the values pre-filled
  $row = mysqli_fetch_assoc($result);
  $appt_time = $row["appt_time"];
  $applicant_id = $row["applicant_id"];
  $recruiter_id = $row["recruiter_id"];

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
