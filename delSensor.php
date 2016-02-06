<?php
$id=$_GET['del'];

$hostname="172.99.75.178";
$username="root";
$password="root";


$dbhandle = mysql_connect($hostname, $username, $password)
  or die("Unable to connect to MySQL");

//select db
$selected = mysql_select_db("SensorInfo",$dbhandle)
  or die("Could not select examples");


$result = mysql_query("Delete FROM sensor_info WHERE id='$id';");

echo $id;
?>
