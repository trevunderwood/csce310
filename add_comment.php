
<!-- this code is for generating a query to insert a comment into the comments database -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csce310";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// making sure we can generate new comment_id by taking the current max one and incrementing it
$sql = "SELECT MAX(comment_id) as max_comment_id FROM comments";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$comment_id = $row['max_comment_id'] + 1;
if (isset($_GET['POST_ID'])) {
  $post_id = $_GET['POST_ID'];
}
// getting the username 
session_start();
$username = $_SESSION['username'];
$sql = "SELECT applicant_id FROM applicant WHERE user_name = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$applicant_id = $row['applicant_id'];

$comment_body = $_POST['comment'];
// inserting the comment into the database
// creating a sql statement with placeholders
$sql = "INSERT INTO comments (comment_id, applicant_id, post_id, comment_body) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
// binding the values to the sql statment
mysqli_stmt_bind_param($stmt, "iiis", $comment_id, $applicant_id, $post_id,$comment_body);
mysqli_stmt_execute($stmt);

mysqli_close($conn);

// redirecting the user back to the comments page with the initial post_id
header("Location: comments.php?POST_ID=" . $post_id);
exit();
?>
