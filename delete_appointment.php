<html>
<!-- Trevor Underwood wrote this file. This code manages the delete appointment page to delete an appointment -->

<head>
    <title>Delete Confirmation</title>
</head>
<body>
    <?php
    
    if (!isset($_GET['APPT_ID'])) { // Check if appointment ID is in url
        
        header("Location: appointments.php"); //redirect back if not
        exit();
    }

    
    $appt_id = $_GET['APPT_ID']; //get appt_id

    
    if (isset($_POST['confirm'])) { //if form is submitted
        // Connect to database server
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "csce310";

        $conn = mysqli_connect($servername, $username, $password, $dbname); //connect to database

        if (!$conn) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM appointments WHERE APPT_ID='$appt_id'"; //delete appointment for passed in appt_id
        $result = mysqli_query($conn, $sql); //run query

        // Close database connection
        mysqli_close($conn);

        header("Location: appointments.php"); //redirect back to appointments page
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
