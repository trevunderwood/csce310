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

    // get information from user currently logged in
    $sql = "SELECT * FROM user WHERE USER_NAME='$username'";
    $response = mysqli_query($conn, $sql);
    if ($response) {
        $info = $response->fetch_assoc();
        // print info from fields in appropriate header
    ?>
    <body>
        <ul>
            <li><a href="posting.php">Postings</a></li>
            <li><a href="appointments.php">Appointments</a></li>
            <li><a href="#">Profile</a></li>
        </ul>
        <h1>Profile</h1>
        <h2>First Name</h2>
        <?php 
            echo $info["USER_FNAME"];
        ?>
        <h2>Last Name</h2>
        <?php 
            echo $info["USER_LNAME"]; 
        ?>
        <h2>Username</h2>
        <?php 
            echo $info["USER_NAME"]; 
        ?>
        <h2>Phone Number</h2>
        <?php 
            echo $info["USER_PHONE"]; 
        ?>
        <h2>E-mail</h2>
        <?php 
            echo $info["USER_EMAIL"]; 
        }
        ?> </br>
        <button type="button"><a href="edit_profile.php">Edit Profile</a></button>
    </body>
    <?php 
    // free query result, end session and close connection
    mysqli_free_result($response);
    session_abort();
    mysqli_close($conn);
    ?>
</html>