<?php
session_start();
include 'config.php'; // Include your database connection code

$message = ""; // Initialize message variable

// Fetch return data from the database
$sql = "SELECT * FROM rentals";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $returns = array();
    while($row = $result->fetch_assoc()) {
        $returns[] = $row;
    }
} else {
    $message = "Tidak ada data pengembalian yang tersedia.";
}

/// Handle delete action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_all'])) {
    $sql = "DELETE FROM rentals WHERE returned_at IS NOT NULL";

    if ($conn->query($sql) === TRUE) {
        $message = "Semua data berhasil dihapus.";
        // Redirect to avoid resubmission on refresh
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Data Pengembalian</title>
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
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Lihat Data Pengembalian</div>
                    <div class="card-body">
                        <?php if (!empty($message)): ?>
                            <div class="alert alert-info"><?php echo $message; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($returns)): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No KTP</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Pembayaran</th>
                                            <th>Waktu Peminjaman</th>
                                            <th>Biaya Tambahan</th>
                                            <th>Waktu Pengembalian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($returns as $return): ?>
                                            <tr>
                                                <td><?php echo $return['ktp']; ?></td>
                                                <td><?php echo $return['name']; ?></td>
                                                <td><?php echo $return['address']; ?></td>
                                                <td><?php echo $return['payment']; ?></td>
                                                <td><?php echo $return['rented_at']; ?></td>
                                                <td><?php echo $return['additional_payment']; ?></td>
                                                <td><?php echo $return['returned_at']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <form method="post">
                                <button type="submit" name="delete_all" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus semua data ini?')">Hapus Data</button>
                            </form>
                        <?php else: ?>
                            <div class="alert alert-info"><?php echo $message; ?></div>
                        <?php endif; ?>
                        <a href="operator.php" class="btn btn-secondary">Kembali ke Menu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
