<!-- <?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csce310";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
#$sql = "SELECT  FROM comments";
$sql = "SELECT * FROM comments WHERE POST_ID = '1'";
$result = $conn->query($sql);
if (mysqli_num_rows($result) > 0) {
  // Loop through the rows and output the data
  while ($row = mysqli_fetch_assoc($result)) {
    $row["APPLICANT_ID"];
    $sql = "SELECT USER_NAME FROM applicant WHERE APPLICANT_ID =" .$row['APPLICANT_ID'];
    $result = $conn->query($sql);
    $name = $result->fetch_assoc();
    echo $name["USER_NAME"];
    echo "<tr><td>" . $row["COMMENT_ID"] . "</td><td>" . $row["APPLICANT_ID"] . "</td><td>" . $row["POST_ID"] . "</td></tr>" . $row["COMMENT_BODY"] . "</td><td>" ;
}
} else {
  echo "0 results";
}

mysqli_close($conn);
?> -->

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

// Query the database to retrieve comments and user names
$sql = "SELECT * FROM comments WHERE POST_ID = '1'";
$result = $conn->query($sql);

// Get the job posting title
$job_posting = "Job Posting Title"; // Replace with actual job posting title

// Output the title and the button
echo "<h1 style='text-align:center;'>Showing comments for " . $job_posting . "</h1>";
echo "<button style='position:absolute;left:10px;top:10px;'>Back to the job posting</button>";

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
  // Loop through the rows and output the data
  while ($row = mysqli_fetch_assoc($result)) {
    $applicant_id = $row["APPLICANT_ID"];
    $sql2 = "SELECT USER_NAME FROM applicant WHERE APPLICANT_ID =" . $applicant_id;
    $result2 = $conn->query($sql2);
    $name = $result2->fetch_assoc();
    $user_name = $name["USER_NAME"];

    // Output the comment details and the associated user name in a rectangular box
    echo "<div class='comment-box'><div class='applicant-id'>" . $user_name . "</div><div class='comment-body'>" . $row["COMMENT_BODY"] . "</div></div>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
?>

<div style='margin-top:50px;text-align:center;'>
  <form>
    <label for='comment'>Leave a comment:</label><br>
    <textarea id='comment' name='comment' rows='5' cols='40'></textarea><br>
    <button type='submit' value='Post'>Post</button>
  </form>
</div>

<style>
.comment-box {
  border: 1px solid #ccc;
  padding: 10px;
  margin-bottom: 10px;
}

.applicant-id {
  font-weight: bold;
  font-size: 16px;
}

.comment-body {
  margin-top: 10px;
}
</style>


