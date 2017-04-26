<?php
             
$servername = "mysql.metropolia.fi";
$username = "juskam";
$password = "password";
$dbname = "juskam";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$id = 44;
$sql = "SELECT date FROM measure WHERE userID = '$id' ORDER BY date DESC LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $lastdate = $row["date"];
    }
}
echo $lastdate;

$conn->close();
?>