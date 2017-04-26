<?php
$q = intval($_GET['q']);

$con = mysqli_connect('mysql.metropolia.fi', 'juskam', 'password', 'juskam');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM measure WHERE measureID = '".$q."'";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)) {
    $values[] .= $row["value"];
}
$avg = array_sum($values) / count($values);
echo $avg . " μV";  



mysqli_close($con);

