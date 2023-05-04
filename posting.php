<!-- Jace Thomas is Responsible for this code -->
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
                        echo "<td>" . $name["COMPANY_NAME"] . "</td><td>" . $row["POST_DESC"] . "</td>";
                        //applicants redirect to apply
                        if($type["USER_TYPE"] == "Applicant"){
                            echo  "<td><a href='app.php?COMPANY_NAME=" . urlencode($name["COMPANY_NAME"]) . "&POST_ID=" . $row["POST_ID"] . "&POST_DESC=" . $row["POST_DESC"] . "'>Apply</a></td>";
                        }
                        //recruites redirect to delete posting
                        else{
                            echo "<td><a href='delete_post.php?POST_ID=" .$row["POST_ID"] . "&POST_DESC=" . $row["POST_DESC"] ."'>Delete Post</td>";
                        }
                        //redirect to comments based on post
                        echo "<td><a href ='comments.php?POST_ID=" .$row["POST_ID"] ."'>Comments</td>";
                    }

                    echo "</tr>";

                    
                }
            }

            //recruiters can create posts
            if($type["USER_TYPE"] == "Recruiter"){
                $sql = "SELECT COMPANY_ID FROM RECRUITER WHERE USER_NAME = '$user'";
                $result = $conn->query($sql);
                $id = $result->fetch_assoc();
                echo "<a href ='create_post.php?COMPANY_ID=". $id["COMPANY_ID"] ."'>Create New Posting</a>";
            }

            $conn->close();
            echo "<a href='application.php'>View Applications</a>";
            
        ?>
</table>
        </div>
<br>
</body>
</html>
