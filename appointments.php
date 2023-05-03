<HTML>

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

$conn = mysqli_connect("localhost", "root", "", "csce310");
#$sql = "SELECT * FROM COMPANY"
#mysqli_query($conn, $sql);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // start table
    echo "<table style='border-collapse: collapse;'>";
    echo "<tr style='text-align: center;'><th style='border: 1px solid black;'>APPT_ID</th><th style='border: 1px solid black;'>APPT_TIME</th><th style='border: 1px solid black;'>APPLICANT_ID</th><th style='border: 1px solid black;'>RECRUITER_ID</th></tr>";
  
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr style='text-align: center;'><td style='border: 1px solid black;'>".$row["APPT_ID"]."</td><td style='border: 1px solid black;'>".$row["APPT_TIME"]."</td><td style='border: 1px solid black;'>".$row["APPLICANT_ID"]."</td><td style='border: 1px solid black;'>".$row["RECRUITER_ID"]."</td> " . "<td><a href='edit_appointment.php?APPT_ID=" . $row['APPT_ID'] . "'>Edit Appointment</a></td>" .  "<td><a href='delete_appointment.php?APPT_ID=" . $row['APPT_ID'] . "'>Delete Appointment</a></td>" . "</tr>";
    }
  
    // end table
    echo "</table>";
  } else {
    echo "0 results";
  }



$conn->close();
?>
<a href="create_appointment.php">Create Appointment</a>

 
 </body>
 </html>
