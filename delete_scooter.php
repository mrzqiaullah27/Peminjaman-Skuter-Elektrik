<?php
include 'config.php';

// Menerima data dari permintaan POST
$scooterId = isset($_POST['scooterId']) ? $_POST['scooterId'] : '';

if (!empty($scooterId)) {
    // Menghapus sepeda motor dari database
    $sql = "DELETE FROM scooter WHERE id = '$scooterId'";
    if ($conn->query($sql) === TRUE) {
        echo "Scooter deleted successfully";
    } else {
        echo "Error deleting scooter: " . $conn->error;
    }
} else {
    echo "Invalid request";
}
?>
