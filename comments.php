<?php
if (isset($_GET['POST_ID'])) {
  $post_id = $_GET['POST_ID'];
}
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
// uses a view called comment_username 
$sql = "SELECT * FROM comment_username WHERE POST_ID = '$post_id'";
$result = $conn->query($sql);

$job_posting = "Job Posting Title"; 

// Output the title and the button
echo "<h1 style='text-align:center;'>Showing comments </h1>";
echo "<a href='posting.php'>Back to the job posting</a>";

// gets the username from login 
session_start();
$username2 = $_SESSION['username'];
if (mysqli_num_rows($result) > 0) {
  // looping through the rows of the output of the query
  while ($row = mysqli_fetch_assoc($result)) {
    $applicant_id = $row["APPLICANT_ID"];
    $user_name = $row["USER_NAME"];

    // outputs the comment details and the associated user name in a rectangular box
    echo "<div class='comment-box'><div class='applicant-id'>" . $user_name . "</div><div class='comment-body'>" . $row["COMMENT_BODY"] . "</div>";
    
    // Check if the comment was made by the current session's user
    if ($username2 == $user_name) {
      // output the delete link
      echo "<a href='delete_comment.php?comment_id=" . $row["COMMENT_ID"] . "&POST_ID=" .$post_id . "'>Delete</a>";
      
      // output the edit link 
      echo "<a href='#' onclick='document.getElementById(\"edit-form-" . $row["COMMENT_ID"] . "\").classList.add(\"show\")'>Edit</a>";
      echo "<form id='edit-form-" . $row["COMMENT_ID"] . "' class='edit-form' action='edit_comment.php' method='POST'>";
      echo "<input type='hidden' name='comment_id' value='" . $row["COMMENT_ID"] . "'>";
      echo "<input type='hidden' name='post_id' value='" . $post_id . "'>";
      echo "<textarea name='comment_body' rows='5' cols='40'>" . $row["COMMENT_BODY"] . "</textarea><br>";
      echo "<button type='submit' value='Save'>Save</button>";
      echo "</form>";

    }

    echo "</div>";
  }
} else {
  echo "0 results";
}
session_abort();
mysqli_close($conn);
?>

<!-- passing information for posting a comment -->
<div style='margin-top:50px;text-align:center;'>
  <form action='add_comment.php?POST_ID=<?php echo $post_id; ?>' method='POST'>
    <label for='comment'>Leave a comment:</label><br>
    <textarea id='comment' name='comment' rows='5' cols='40'></textarea><br>
    <button type='submit' value='Post'>Post</button>
  </form>
</div>

<!-- The edit form -->
<div id="edit-form" style="display:none;margin-top:50px;text-align:center;">
  <form action="edit_comment.php" method="POST">
    <input type="hidden" name="comment_id" value="">
    <textarea name="comment_body" rows="5" cols="40"></textarea><br>
    <button type="submit" value="Save">Save</button>
  </form>
</div>

<!-- styling for the comments -->
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

.edit-form {
  display: none;
}

.edit-form.show {
  display: block;
}
</style>


