<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csce310";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// Get the next comment_id
$sql = "SELECT MAX(comment_id) as max_comment_id FROM comments";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$comment_id = $row['max_comment_id'] + 1;
if (isset($_GET['POST_ID'])) {
  $post_id = $_GET['POST_ID'];
}
// Get the applicant_id for the logged-in user
session_start();
$username = $_SESSION['username'];
$sql = "SELECT applicant_id FROM applicant WHERE user_name = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$applicant_id = $row['applicant_id'];

// Get the comment_body from the form submission
$comment_body = $_POST['comment'];
// Insert the comment into the database
$sql = "INSERT INTO comments (comment_id, applicant_id, post_id, comment_body) VALUES (?, ?, ?, ?)";
$new_count++;
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "iiis", $comment_id, $applicant_id, $post_id,$comment_body);
mysqli_stmt_execute($stmt);

// Close the database connection
mysqli_close($conn);

// Redirect the user back to the comments page
header("Location: comments.php?POST_ID=" . $post_id);
exit();
?>
