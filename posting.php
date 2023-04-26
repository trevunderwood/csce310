<!DOCTYPE html>
<html>
<body>

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
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "csce310";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error){
                die("Connection Failed: " . $conn->connection_error);
            }

            $sql = "SELECT * from job_posting";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<tr>";
                    $sql = "SELECT COMPANY_NAME from COMPANY where COMPANY_ID = ". $row["COMPANY_ID"];
                    $comp_result = $conn->query($sql);
                    while($name = $comp_result->fetch_assoc()){
                        echo "<td>" . $name["COMPANY_NAME"] . "</td> <td>" . $row["POST_DESC"] . "</td>";
                    }
                    echo "</tr>";

                    
                }
            }

            $conn->close()
        ?>
</table>
        </div>
<br>
<p> <a href="app.php">Click here to fill out an application </a>.</p>
</body>
</html>