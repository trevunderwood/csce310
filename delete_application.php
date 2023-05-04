<html>
    <head>
        <title> Delete Confirmation </title>
    </head>
    <h2> Are you sure you would like to delete your Application? </h2>
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

    if(isset($_GET["APPLICATION_ID"])){
        //get values from url
        $appid = $_GET["APPLICATION_ID"];

        $company = $_GET["COMPANY_NAME"];

        $post = $_GET["POST_DESC"];

        echo "Application Details:";

        echo "<br>";
        //display relevant information
        echo $company;

        echo "<br>";

        echo $post;

        echo "<br>";
    }
    // check for confirmation
    if (isset($_POST['deny'])) {
        // send back to application page
        header("Location: application.php");
    }
    if (isset($_POST['confirm'])) {
        // Delete application
            $sql = "DELETE FROM APPLICATIONS WHERE APPLICATION_ID='$appid'";

            $result = mysqli_query($conn, $sql);
            header("Location: application.php");
            // return to applications page
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