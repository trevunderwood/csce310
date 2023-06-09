<!-- Jace Thomas is Responsible for this code -->
<html>
    <head>
        <title> Delete Confirmation </title>
    </head>
    <h2> Are you sure you would like to delete this Job Posting? </h2>
    <?php

    // Connect to database server
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "csce310";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    }

    session_start();
    $username = $_SESSION['username'];

    if(isset($_GET["POST_ID"])){
        //get values from url
        $postid = $_GET["POST_ID"];

        $post = $_GET["POST_DESC"];

        echo "Application Details:";

        echo "<br>";
        //display relevant information
        echo $post;

        echo "<br>";
    }
    // check for confirmation
    if (isset($_POST['deny'])) {
        // send back to posting page
        header("Location: posting.php");
    }
    if (isset($_POST['confirm'])) {
        // Delete posting and any entity with foreign keys related to the post
            $sql = "DELETE FROM APPLICATIONS WHERE POST_ID= '$postid'";

            $result = mysqli_query($conn, $sql);

            $sql = "DELETE FROM COMMENTS WHERE POST_ID= '$postid'";

            $result = mysqli_query($conn, $sql);

            $sql = "DELETE FROM JOB_POSTING WHERE POST_ID ='$postid'";

            $result = mysqli_query($conn, $sql);

            header("Location: posting.php");
        }

        // end session and close connection
        session_abort();
        mysqli_close($conn);
    ?>
    <body>
        <form method="post">
            <input type="submit" name="confirm" value="Yes">
            <input type="submit" name="deny" value="No">
        </form>
    </body>
</html>