<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: deepskyblue;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Menu Utama</div>
                    <div class="card-body">
                        <a href="record_rental.php" class="btn btn-primary btn-block">Rekam Transaksi Sewa</a>
                        <a href="search_renter.php" class="btn btn-primary btn-block">Cari Penyewa</a>
                        <a href="return_scooter.php" class="btn btn-primary btn-block">Rekam Pengembalian Skuter</a>
                        <a href="view_returns.php" class="btn btn-primary btn-block">Lihat Data Pengembalian</a>
                        <a href="login.php" class="btn btn-danger btn-block">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
