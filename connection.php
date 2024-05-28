<?php
$servername = "localhost"; // nama host server
$username = "username"; // username database
$password = "password"; // password database
$dbname = "peminjaman_scooter_electric"; // nama database

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
echo "Koneksi berhasil";

// Tutup koneksi
mysqli_close($conn);
?>
