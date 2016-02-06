<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "SensorData";
$rows = array();
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM (SELECT * FROM sensor_data WHERE sensor_type='water-level' ORDER BY sensor_id, auto DESC, sensor_name, sensor_type, sensor_value)xy GROUP BY sensor_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
       $rows[] = $row;
    }
	print json_encode($rows);
}

$conn->close();
?>

