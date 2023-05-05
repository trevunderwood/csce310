<!-- this code is for generating a query to delete a comment in the comments database -->
<?php
session_start();

$comment_id = $_GET['comment_id'];

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csce310";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// SQL query to delete the comment
// creating a sql statement with placeholders
$sql = "DELETE FROM comments WHERE COMMENT_ID = ?";

// preparing the statement and bind the parameter
$stmt = mysqli_prepare($conn, $sql);
// binding the values to the sql statment
mysqli_stmt_bind_param($stmt, "i", $comment_id);
mysqli_stmt_execute($stmt);

if (isset($_GET['POST_ID'])) {
    $post_id = $_GET['POST_ID'];
  }
mysqli_close($conn);

// redirect the user back to the comments page with proper post id
header("Location: comments.php?POST_ID=" . $post_id);
exit();
?>
