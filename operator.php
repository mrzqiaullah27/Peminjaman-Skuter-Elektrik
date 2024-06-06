<?php
include 'config.php';
session_start();

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
        .logout-button {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #dc3545;
            border: circular;
            border-radius: 10px;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .logout-button:hover {
            background-color: #c82333;
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
                        <a href="rekampeminjaman.php" class="btn btn-primary btn-block">Rekam Transaksi Sewa</a>
                        <a href="caripeminjam.php" class="btn btn-primary btn-block">Cari Penyewa</a>
                        <a href="kembalikanscooter.php" class="btn btn-primary btn-block">Rekam Pengembalian Skuter</a>
                        <a href="pengembalian.php" class="btn btn-primary btn-block">Lihat Data Pengembalian</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="logout-button" href="index.php">Logout</a>
    </div>
</body>
</html>
