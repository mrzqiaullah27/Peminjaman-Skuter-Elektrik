<?php
include 'config.php';

// Ambil parameter tanggal mulai dan tanggal akhir dari form
$tanggal_mulai = isset($_POST['tanggal_mulai']) ? $_POST['tanggal_mulai'] : '';
$tanggal_akhir = isset($_POST['tanggal_akhir']) ? $_POST['tanggal_akhir'] : '';

// Lakukan kueri SQL untuk mendapatkan laporan transaksi berdasarkan scooter dan periode tertentu
$sql = "SELECT * FROM transaksi_penyewaan
        INNER JOIN scooter ON transaksi_penyewaan.scooter_id = scooter.id
        WHERE tanggal_sewa BETWEEN '$tanggal_mulai' AND '$tanggal_akhir'";
$result = $conn->query($sql);

// Tampilkan laporan transaksi penyewaan berdasarkan scooter
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Tampilkan detail transaksi
    }
} else {
    echo "No transactions found for the specified period.";
}
// Ambil parameter tanggal mulai dan tanggal akhir dari form
$tanggal_mulai = isset($_POST['tanggal_mulai']) ? $_POST['tanggal_mulai'] : '';
$tanggal_akhir = isset($_POST['tanggal_akhir']) ? $_POST['tanggal_akhir'] : '';

// Lakukan kueri SQL untuk mendapatkan laporan transaksi berdasarkan penyewa dan periode tertentu
$sql = "SELECT * FROM transaksi_penyewaan
        INNER JOIN pengguna ON transaksi_penyewaan.pengguna_id = pengguna.id
        WHERE tanggal_sewa BETWEEN '$tanggal_mulai' AND '$tanggal_akhir'";
$result = $conn->query($sql);

// Tampilkan laporan transaksi penyewaan berdasarkan penyewa
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Tampilkan detail transaksi
    }
} else {
    echo "No transactions found for the specified period.";
}
$sql = "SELECT scooter_id, COUNT(*) AS total_sewa FROM transaksi_penyewaan GROUP BY scooter_id ORDER BY total_sewa DESC";
$result = $conn->query($sql);

$ranking_scooter = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ranking_scooter[] = $row;
    }
}

// Tampilkan urutan peringkat scooter terlaris
foreach ($ranking_scooter as $rank) {
    echo "Scooter ID: " . $rank['scooter_id'] . ", Total Sewa: " . $rank['total_sewa'] . "<br>";
}
include 'config.php';

$sql = "SELECT pengguna_id, COUNT(*) AS total_sewa FROM transaksi_penyewaan GROUP BY pengguna_id ORDER BY total_sewa DESC";
$result = $conn->query($sql);

$ranking_penyewa = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ranking_penyewa[] = $row;
    }
}

// Tampilkan peringkat penyewa yang paling sering menyewa scooter
foreach ($ranking_penyewa as $rank) {
    echo "Pengguna ID: " . $rank['pengguna_id'] . ", Total Sewa: " . $rank['total_sewa'] . "<br>";
}
?>
<!DOCTYPE html>
<style>
   
body {
    font-family: Arial, sans-serif;
    background-color: #f0f7ff; /* Biru muda untuk latar belakang */
    color: #333; /* Warna teks */
}

h1, h2 {
    color: #007bff; /* Biru untuk judul */
}

form, table {
    background-color: #ffffff; /* Warna latar belakang untuk form dan tabel */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Efek bayangan */
}

input[type="text"], input[type="date"], select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"], button {
    background-color: #007bff; /* Biru untuk tombol */
    color: #fff; /* Warna teks tombol */
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover, button:hover {
    background-color: #0056b3; /* Warna biru yang sedikit lebih gelap saat tombol dihover */
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
<html lang="en">
<head>
      <a class="logout-button" href="index.php">Logout</a>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pimpinan Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Pimpinan Dashboard</h1>
    <button onclick="showScooters()">Show Scooters</button>
    <h2>Cari dan Lihat Data Scooter</h2>
    <form action="view_scooter.php" method="post">
        <label for="search_date_start">Tanggal Mulai:</label>
        <input type="date" id="search_date_start" name="search_date_start" required>
        <label for="search_date_end">Tanggal Akhir:</label>
        <input type="date" id="search_date_end" name="search_date_end" required>
        <input type="submit" value="Cari">
    </form>
    
    <h2>Lihat Laporan Transaksi Penyewaan</h2>
    <form action="view_transaction_report.php" method="post">
        <label for="transaction_date_start">Tanggal Mulai:</label>
        <input type="date" id="transaction_date_start" name="transaction_date_start" required>
        <label for="transaction_date_end">Tanggal Akhir:</label>
        <input type="date" id="transaction_date_end" name="transaction_date_end" required>
        <input type="submit" value="Lihat Laporan">
    </form>
    
    <h2>Lihat Statistik</h2>
    <button onclick="showTopScooters()">Lihat Top Scooters</button>
    <button onclick="showTopRenters()">Lihat Top Renters</button>
    

</body>
</html>
<script>function validateForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var role = document.getElementById("role").value;

    if (username == "" || password == "" || role == "") {
        alert("All fields are required.");
        return false;
    }
    return true;
}
 function showScooters() {
    window.location.href="data scooter lengkap.php";
    }
</script>
