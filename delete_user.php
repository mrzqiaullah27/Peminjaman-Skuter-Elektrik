<?php
include 'config.php';

// Menerima data dari permintaan POST
$userId = isset($_POST['userId']) ? $_POST['userId'] : '';

if (!empty($userId)) {
    // Menghapus pengguna dari database
    $sql = "DELETE FROM user WHERE id = '$userId'";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "Invalid request";
}
?>
