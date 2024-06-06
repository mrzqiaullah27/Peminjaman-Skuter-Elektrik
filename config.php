<?php
$host = "localhost";
$user = "root";
$pass = "W7301@jqir#";
$db = "peminjaman_scooter_electric";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
