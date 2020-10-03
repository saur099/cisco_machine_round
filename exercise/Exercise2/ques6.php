<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cisco_mr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$n = 5;
 
for($i=0; $i<=$n; $i++)
{
	$routerName = "Router".rand();
	$ip_addr = "127.0.0.".rand(01,99);
	$sapid = "Sapid".rand(00,99);
	$hostname = "Localhost".rand(00,99);
	$loopback = "loop".rand(0,99);
	$mac = "1222.22.21.".rand(10,99);
	$sql = "INSERT INTO `router`( `routerName`, `SAPID`, `Hostname`, `Loopback_ipv4`, `MacAddress`, `ip_addr`) 
		VALUES ( '".$routerName."', '".$sapid."', '".$hostname."', '".$loopback."',  '".$mac."', '".$ip_addr."')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully <br/>";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
}

$conn->close();
?>