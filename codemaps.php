<?php
$servername = "172.99.75.178";
$username = "root";
$password = "root";
$dbname = "SensorInfo";
$rows = array();
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select name,lat,longi from sensor_info";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
       $rows[] = $row;
    }
	print json_encode($rows);
}

$conn->close();
?>

