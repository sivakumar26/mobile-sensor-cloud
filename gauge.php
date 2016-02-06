<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SensorData";
$rows = array();
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select sensor_value from sensor_data where sensor_type='water level' ORDER BY sensor_id LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
      while($row = $result->fetch_assoc()) {
    
		$rows[] = $row;
	
	}

	print json_encode($rows);
}

$conn->close();
?>