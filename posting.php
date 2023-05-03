<!DOCTYPE html>
<html>
<body>
<ul>
    <li><a href="posting.php">Postings</a></li>
    <li><a href="appointments.php">Appointments</a></li>
    <li><a href="user_profile.php">Profile</a></li>
    <li><a href="login.html">Logout</a></li>
</ul>
<h1>Job Postings</h1>
<br>
<div>
<table align = "left" border = "1" cellpadding = "3" cellspacing = "0">
    <tr>
        <td>
            COMPANY
        </td>
        <td>
            Job Title
        </td>
        <td>
        </td>
        <?php
            //define connection variables
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "csce310";

            //initiate connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if (!$conn){
                die("Connection failed: " . mysqli_connect_error());
            }

            session_start();
            $user = $_SESSION['username'];

            $sql = "SELECT USER_TYPE FROM USER WHERE USER_NAME = '$user'";
            $result = $conn->query($sql);
            $type = $result->fetch_assoc();

            //Define query and execute
            $sql = "SELECT * from job_posting";

            $result = $conn->query($sql);

            //create table from fetching query
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<tr>";
                    $sql = "SELECT COMPANY_NAME from COMPANY where COMPANY_ID = ". $row["COMPANY_ID"];
                    $comp_result = $conn->query($sql);

                    while($name = $comp_result->fetch_assoc()){
                        echo "<td>" . $name["COMPANY_NAME"] . "</td> <td>" . $row["POST_DESC"] . "</td><td><a href='app.php?COMPANY_NAME=" . urlencode($name["COMPANY_NAME"]) . "&POST_ID=" . $row["POST_ID"] . "&POST_DESC=" . $row["POST_DESC"] . "'>Apply</a></td>";
                    }
                    echo "</tr>";

                    
                }
            }

            $conn->close();
            echo "<a href='application.php'>View Applications</a>";
            
        ?>
</table>
        </div>
<br>
</body>
</html>
