<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$susername = "root";
$password = "";
$dbname = "coffee";
$conn = new mysqli($servername, $susername, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>