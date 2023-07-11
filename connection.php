<?php
ob_start();
$servername = "mysql";
$username = "aditya";
$password = "magento123";
$db="notes";
// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connection Established successfully";
?>