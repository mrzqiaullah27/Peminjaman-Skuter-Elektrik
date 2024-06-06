<?php
include 'config.php';

// Menerima data dari permintaan POST
$scooterId = isset($_POST['scooterId']) ? $_POST['scooterId'] : '';
$newStatus = isset($_POST['newStatus']) ? $_POST['newStatus'] : '';

if (!empty($scooterId) && !empty($newStatus)) {
    // Melakukan pembaruan status sepeda motor di database
    $sql = "UPDATE scooter SET status = '$newStatus' WHERE id = '$scooterId'";
    if ($conn->query($sql) === TRUE) {
        echo "Scooter status updated successfully";
    } else {
        echo "Error updating scooter status: " . $conn->error;
    }
} else {
    echo "Invalid request";
}
?>
