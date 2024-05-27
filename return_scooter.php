<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
date_default_timezone_set('Asia/Jakarta');
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ktp = $_POST['ktp'];
    $additional_payment = $_POST['additional_payment'];
    $returned_at = date('Y-m-d H:i:s'); // Current date and time

    $sql = "UPDATE rentals SET additional_payment='$additional_payment', returned_at='$returned_at' 
            WHERE ktp='$ktp' AND returned_at IS NULL";

    if ($conn->query($sql) === TRUE) {
        echo "Pengembalian berhasil direkam";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Pengembalian Skuter</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Rekam Pengembalian Skuter</div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="ktp">No KTP</label>
                                <input type="text" name="ktp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="additional_payment">Biaya Sewa Tambahan</label>
                                <input type="number" name="additional_payment" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Rekam Pengembalian</button>
                            <a href="menu.php" class="btn btn-secondary">Kembali ke Menu</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
