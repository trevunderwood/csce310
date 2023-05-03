<html>
    <head>
        <title> Delete Confirmation </title>
    </head>
    <?php
    // check for confirmation
    if (isset($_POST['deny'])) {
        // send back to profile page
        header("Location: appointments.php");
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

        $appt_id = $_POST["appt_id"];
        $sql = "DELETE FROM appointments WHERE APPT_ID='$appt_id'";

        $result = mysqli_query($conn, $sql);

        // end session and close connection
        header("Location: appointments.php");
        mysqli_close($conn);
    }
    ?>
    <body>
        <h1> Are you sure you would like to delete your appointment? </h1>
        <form method="post">
            <input type="hidden" name="appt_id" value="$appt_id">
            <input type="submit" name="confirm" value="Yes">
            <input type="submit" name="deny" value="No">
        </form>
    </body>
</html>
