<?php
$dbuser = "root";
$dbpass = "";
$dbhost = "localhost";
$dbname = "library";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
