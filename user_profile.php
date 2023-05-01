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
    ?>
    <body>
        <ul>
            <li><a href="posting.php">Postings</a></li>
            <li><a href="#">Appointments</a></li>
            <li><a href="#">Profile</a></li>
        </ul>
        <h1>Profile</h1>
        <h2>First Name</h2>
        <?php 
        session_start();
        $username = $_SESSION['username'];
        $sql = "SELECT USER_FNAME FROM user WHERE USER_NAME='$username'";
 
        $response = mysqli_query($conn, $sql);

        if (mysqli_num_rows($response) == 1) {
            echo "First Name " . mysqli_num_rows($response);
            mysqli_free_result($response);
        }
        ?>
        <h2>Last Name</h2>
        <h2>Username</h2>
        <h2>Phone Number</h2>
        <h2>Email</h2>
        <button type="button"><a href="edit_profile.php">Edit Profile</a></button>
    </body>
    <?php mysqli_close($conn) ?>
</html>