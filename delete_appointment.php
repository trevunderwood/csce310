<html>
<head>
    <title>Delete Confirmation</title>
</head>
<body>
    <?php
    // Check if appointment ID is set in the URL
    if (!isset($_GET['APPT_ID'])) {
        // If appointment ID is not set, redirect to appointments page
        header("Location: appointments.php");
        exit();
    }

    // Store appointment ID from URL parameter
    $appt_id = $_GET['APPT_ID'];

    // Check if confirmation form is submitted
    if (isset($_POST['confirm'])) {
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

        // Delete appointment from database
        $sql = "DELETE FROM appointments WHERE APPT_ID='$appt_id'";
        $result = mysqli_query($conn, $sql);

        // Close database connection
        mysqli_close($conn);

        // Redirect to appointments page
        header("Location: appointments.php");
        exit();
    }
    ?>

    <h1>Are you sure you would like to delete your appointment?</h1>
    <form method="post">
        <input type="submit" name="confirm" value="Yes">
        <a href="appointments.php"><button type="button">No</button></a>
        <input type="hidden" name="appt_id" value="<?php echo $appt_id; ?>">
    </form>
</body>
</html>
