<?php 

$connection = mysqli_connect('mysql.metropolia.fi', 'juskam', 'password', 'juskam');
$sql = mysqli_query($connection, "SELECT date, measureID FROM measure");
$mesures = array();
$str = "[";
while ($row = $sql->fetch_assoc()){
    $id = $row['measureID'];
    $time = $row['date'];
    $str .= '{"date":"' . $time .  '","url":"' . "http://users.metropolia.fi/~juskam/epower/results.php?id=" . $id .  '","title":"' . "Measure " . $id . '"},';
}
$str = rtrim($str,',');
$str .= "]";
echo $str;

?>
