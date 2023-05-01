<html>
    <head>
        <title> Delete Confirmation </title>
    </head>
    <?php
    // check for confirmation
    if (isset($_POST['deny'])) {
        // send back to profile page
        header("Location: user_profile.php");
    }
    if (isset($_POST['confirm'])) {
        // Delete user, return to login

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

        $sql = "DELETE FROM user WHERE USER_NAME='$username'";

        $result = mysqli_query($conn, $sql);

        // end session and close connection
        session_abort();
        mysqli_close($conn);
    }
    ?>
    <body>
        <h1> Are you sure you would like to delete your Profile? </h1>
        <form method="post">
            <input type="submit" name="confirm" value="Yes">
            <input type="submit" name="deny" value="No">
        </form>
    </body>
</html>
