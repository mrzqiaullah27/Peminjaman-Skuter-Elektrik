<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scooter Rental</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Operator Peminjaman Skuter Elektrik</h1>

        <div class="form-container">
            <h2>Rekam Transaksi Penyewaan Skuter</h2>
            <form action="rekampeminjaman.php" method="post">
                <input type="text" name="id_card" placeholder="No. KTP" maxlength="16" required>
                <input type="text" name="name" placeholder="Nama" required>
                <input type="text" name="address" placeholder="Alamat" required>
                <input type="number" name="payment" placeholder="Pembayaran untuk satu jam" required>
                <button type="submit">Rekam Transaksi Sewa</button>
            </form>
        </div>

        <div class="form-container">
            <h2>Pencarian Penyewa Skuter</h2>
            <form action="caripeminjaman.php" method="get">
                <input type="text" name="id_card" placeholder="No. KTP" maxlength="16" required>
                <button type="submit">Cari Penyewa</button>
            </form>
        </div>

        <div class="form-container">
            <h2>Rekam Transaksi Pengembalian Skuter</h2>
            <form action="rekampengembalian.php" method="post">
                <input type="text" name="id_card" placeholder="No. KTP" maxlength="16" required>
                <input type="number" name="additional_fee" placeholder="Biaya Tambahan" required>
                <button type="submit">Rekam Pengembalian</button>
            </form>
        </div>
    </div>
</body>
</html>
