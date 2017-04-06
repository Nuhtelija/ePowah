<link rel="stylesheet" href="css/results.css">

<?php
$title = "Results";
session_start();
require_once 'nav.php';

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

$sql = "SELECT value FROM measure";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $values = $row["value"];
    }
} else {
    echo "0 results";
}
$conn->close();
?>

<div class='wrapper'>
        <div class='title'>Measure</div>
        <div class='chart' id='p1'>
            <canvas id='c1'></canvas>
        </div>
        <div class='footer'>
            <p>Lorem ipsum</p>
        </div>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/Chart.js/0.2.0/Chart.min.js'></script>
    <script>
        var c1 = document.getElementById("c1");
var parent = document.getElementById("p1");
c1.width = parent.offsetWidth - 40;
c1.height = parent.offsetHeight - 40;

var data1 = {
  labels : ["0","1","2","3","4","5","6","7","8","9","10"],
  datasets : [
    {
      fillColor : "rgba(255,255,255,.1)",
      strokeColor : "rgba(255,255,255,1)",
      pointColor : "#123",
      pointStrokeColor : "rgba(255,255,255,1)",
      data : <?php echo $values?>
    }
  ]
}

var options1 = {
  scaleFontColor : "rgba(255,255,255,1)",
  scaleLineColor : "rgba(255,255,255,1)",
  scaleGridLineColor : "transparent",
  bezierCurve : false,
  scaleOverride : true,
  scaleSteps : 5,
  scaleStepWidth : 100,
  scaleStartValue : 0
}

new Chart(c1.getContext("2d")).Line(data1,options1)
    </script>


</body>

</html>