<HTML>

<html> 
 <title>HTML with PHP</title>
 <body>
 <h1>My Example</h1>
 <?php
echo "Howdy World!" . "<br>";
$conn = mysqli_connect("localhost", "root", "", "csce310");
#$sql = "SELECT * FROM COMPANY"
#mysqli_query($conn, $sql);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$sql = "INSERT INTO USER (USER_NAME, USER_LNAME, USER_FNAME, USER_PHONE, USER_EMAIL, USER_TYPE)
VALUES ('test', 'Underwood', 'Trevor', '1234567890', 'test@test.com', 'APPLICANT')";

// $sql = "SELECT COMPANY_NAME FROM COMPANY";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     echo "company name: " . $row["COMPANY_NAME"]. "<br>";
//   }
// } else {
//   echo "0 results";
// }

if ($conn->query($sql) === TRUE) {
echo "New record created successfully";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
 <b>Here is some more HTML</b>
 <?php
 //more PHP code
 ?>
 
 </body>
 </html>
