<!--
The create user functionality was implemented by John Nolen
This file accepts information in fields from a user.
A post request is made which INSERTs the new user into the user table
along with the relevent user type table.
If the user is an Applicant, the user and applicant tables are inserted to.
If the user is a Recruiter, an insert is made to the user and recruiter tables.
-->
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

// Check if the user registration form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Get the input values from the form
  $username = $_POST["username"];
  //$password = $_POST["password"];
  $lname = $_POST["lname"];
  $fname = $_POST["fname"];
  $phone = $_POST["phone"];
  $email = $_POST["email"];
  $usertype = $_POST["usertype"];

  // Insert the new user into the database
  $sql = "INSERT INTO user (USER_NAME, USER_LNAME, USER_FNAME, USER_PHONE, USER_EMAIL, USER_TYPE)
VALUES ('$username', '$lname', '$fname', '$phone', '$email', '$usertype')";
  $result = mysqli_query($conn, $sql);
    //echo "result run";

  // check usertype and update appropriate table
  if ($usertype == "Applicant") {
    // update applicant table
    $sql = "INSERT INTO applicant (USER_NAME) VALUES ('$username')";
    $result = mysqli_query($conn, $sql);
  }
  if ($usertype == "Recruiter") {
    // get company ID
    $companyname = $_POST["company"];
    $sql = "SELECT COMPANY_ID from company WHERE COMPANY_NAME='$companyname'";
    $result = mysqli_query($conn, $sql);

    // update recruiter table
    $companyID = $result->fetch_assoc()['COMPANY_ID'];
    $sql = "INSERT INTO recruiter (USER_NAME,COMPANY_ID) VALUES ('$username','$companyID')";
    $result = mysqli_query($conn, $sql);
  }
  if ($result) {
    // User was added successfully, redirect to the login page
    //echo "added user";
    header("Location: login.html");
  } else {
    // There was an error adding the user to the database
    echo "Error: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>
<script>
  // this function runs on click from the user type dropdown
  function showField() {
    // get user type
    var option = document.getElementById("usertype").value;
    // open up the company field if user is a Recruiter
    if (option == "Recruiter") {
      document.getElementById("hiddenField").style.display = "block";
    } else {
      document.getElementById("hiddenField").style.display = "none";
    }
  }
</script>
<!DOCTYPE html>
<html>
<head>
	<title>Create User Page</title>
</head>
<body>
	<h2>Create a New User Account</h2>
  <!-- This form collects data for the new user -->
	<form method="post" action="create_user.php">
		<label>Username:</label>
		<input type="text" name="username" required>
		<br>
		<label>Last Name:</label>
		<input type="text" name="lname" required>
		<br>
		<label>First Name:</label>
		<input type="text" name="fname" required>
		<br>
		<label>Phone Number:</label>
		<input type="text" name="phone" required>
		<br>
		<label>Email:</label>
		<input type="text" name="email" required>
		<br>
    <label>User Type:</label>
    <select id="usertype" name="usertype" onchange="showField()">
        <option value="Applicant">Applicant</option>
        <option value="Recruiter">Recruiter</option>
    </select>
    <br>
    <!-- The company name is only requested if the new user is a Recruiter -->
    <div id="hiddenField" style="display:none;">
      <label>Company:</label>
      <input type="text" name="company">
    </div>
		<input type="submit" value="Create Account">
	</form>
</body>
</html>