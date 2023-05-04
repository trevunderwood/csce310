<!--
This file was written by John Nolen
This file contains the functionality for deleting a user.
A user is asked for confirmation that they would like to delete their
profile. If denied, the user is redirected back to their profile page.
If confirmed, a DELETE removes the user from all related databases and 
the user is redirected to the login page.
-->
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

        // check user type and delete from appropriate table
        $sql = "SELECT USER_TYPE FROM user WHERE USER_NAME='$username'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $usertype = $result->fetch_assoc()['USER_TYPE'];
        }

        if ($usertype == 'Applicant') {
            $sql = "DELETE FROM applicant WHERE USER_NAME='$username'";
            $result = mysqli_query($conn, $sql);
        }
        if ($usertype == 'Recruiter') {
            $sql = "DELETE FROM recruiter WHERE USER_NAME='$username'";
            $result = mysqli_query($conn, $sql);
        }

        // delete from user table
        $sql = "DELETE FROM user WHERE USER_NAME='$username'";
        $result = mysqli_query($conn, $sql);

        // end session and close connection
        session_abort();
        mysqli_close($conn);
        // return to login page
        header("Location: login.html");
    }
    ?>
    <body>
        <!-- Get confirmation for DELETE -->
        <h1> Are you sure you would like to delete your Profile? </h1>
        <form method="post">
            <input type="submit" name="confirm" value="Yes">
            <input type="submit" name="deny" value="No">
        </form>
    </body>
</html>
