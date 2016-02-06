<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "SensorData";
$rows = array();
$conn = new mysqli($servername, $username, $password, $dbname);
extract( $_GET);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "select * from sensor_data where sensor_id='$id' ORDER BY auto DESC LIMIT 6;";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
       $rows[] = $row;
    }
	print json_encode($rows);
}

$conn->close();
?>
