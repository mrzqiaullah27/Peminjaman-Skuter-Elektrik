<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "peminjaman_scooter_electric";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// This function can be used to get the connection in other scripts
function get_db_connection() {
    global $conn;
    return $conn;
}
?>
