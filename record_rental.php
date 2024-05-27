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
    $name = $_POST['name'];
    $address = $_POST['address'];
    $payment = $_POST['payment'];
    $rented_at = date('Y-m-d H:i:s'); // Current date and time
    $username = $_SESSION['username'];

    $sql = "INSERT INTO rentals (ktp, name, address, payment, rented_at, username) 
            VALUES ('$ktp', '$name', '$address', '$payment', '$rented_at', '$username')";

    if ($conn->query($sql) === TRUE) {
        echo "Transaksi sewa berhasil direkam";
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
    <title>Rekam Transaksi Sewa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Rekam Transaksi Sewa</div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="ktp">No KTP</label>
                                <input type="text" name="ktp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="payment">Pembayaran untuk Jam Pertama</label>
                                <input type="number" name="payment" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Rekam Transaksi</button>
                            <a href="menu.php" class="btn btn-secondary">Kembali ke Menu</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
