<html>
    <head>
        <title>User Profile Page</title>
    </head>
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

    // check for update submission
    if (isset($_POST['update'])) {
        //check for update submissions for fields in USER table
        if (isset($_POST['fname']) && trim($_POST['fname']) !== "") {
            // update USER_FNAME
            $fname = $_POST['fname'];
            $sql = "UPDATE user SET USER_FNAME='$fname' WHERE USER_NAME='$username'";
            $result = mysqli_query($conn, $sql);
        }
        if (isset($_POST['lname']) && trim($_POST['lname']) !== "") {
            // update USER_LNAME
            $lname = $_POST['lname'];
            $sql = "UPDATE user SET USER_LNAME='$lname' WHERE USER_NAME='$username'";
            $result = mysqli_query($conn, $sql);
        }
        if (isset($_POST['phone']) && trim($_POST['phone']) !== "") {
            // update USER_PHONE
            $phone = $_POST['phone'];
            $sql = "UPDATE user SET USER_PHONE='$phone' WHERE USER_NAME='$username'";
            $result = mysqli_query($conn, $sql);
        }
        if (isset($_POST['email']) && trim($_POST['email']) !== "") {
            // update USER_EMAIl
            $email = $_POST['email'];
            $sql = "UPDATE user SET USER_EMAIL='$email' WHERE USER_NAME='$username'";
            $result = mysqli_query($conn, $sql);
        }
        // end session and close connection
        session_abort();
        mysqli_close($conn);
        // redirect to profile page
        header("Location: user_profile.php");
    }
    // end session and close connection
    session_abort();
    mysqli_close($conn);
    ?>
    <body>
        <ul>
            <li><a href="posting.php">Postings</a></li>
            <li><a href="appointments.php">Appointments</a></li>
            <li><a href="user_profile.php">Profile</a></li>
        </ul>
        <h1>Edit Profile</h1>
        <p> Enter any updated information </p>
        <form method="post">
            First Name: <input type="text" name="fname"><br>
            Last Name: <input type="text" name="lname"><br>
            Phone: <input type="text" name="phone"><br>
            E-mail: <input type="text" name="email"><br>
            <input type="submit" name="update"><br>
        </form>
        <form action="delete_profile.php" method="post">
            <input type="submit" value="Delete Profile">
        </form>
    </body>
</html>