
<!-- this code is for generating a query to update a comment in the comments database -->
<?php
if (isset($_POST['comment_id']) && isset($_POST['comment_body'])) {
  $comment_id = $_POST['comment_id'];
  $comment_body = $_POST['comment_body'];

  // Establish a connection to the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "csce310";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // updating the comment in the database with the new comment_body
  $sql = "UPDATE comments SET COMMENT_BODY = '$comment_body' WHERE COMMENT_ID = '$comment_id'";
  if (mysqli_query($conn, $sql)) {
    echo "Comment updated successfully!";
  } else {
    echo "Error updating comment: " . mysqli_error($conn);
  }

  mysqli_close($conn);
}

$post_id = $_POST['post_id'];
// returing user back to comment page with the proper post_id
header("Location: comments.php?POST_ID=" . $post_id);
exit();
?>
