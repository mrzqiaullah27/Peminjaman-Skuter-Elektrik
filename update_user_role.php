<?php
include 'config.php';

// Menerima data dari permintaan POST
$userId = isset($_POST['userId']) ? $_POST['userId'] : '';
$newRole = isset($_POST['newRole']) ? $_POST['newRole'] : '';

if (!empty($userId) && !empty($newRole)) {
    // Melakukan update peran pengguna di database
    $sql = "UPDATE user SET role = '$newRole' WHERE id = '$userId'";
    if ($conn->query($sql) === TRUE) {
        echo "User role updated successfully";
    } else {
        echo "Error updating user role: " . $conn->error;
    }
} else {
    echo "Invalid request";
}
?>
