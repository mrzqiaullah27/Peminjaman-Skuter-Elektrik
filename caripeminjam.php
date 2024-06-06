<?php
session_start();

include 'config.php';
$rentals = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ktp = $_POST['ktp'];

    $sql = "SELECT * FROM rentals WHERE ktp='$ktp' AND returned_at IS NULL";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rentals[] = $row;
        }
    } else {
        $message = "Tidak ada data penyewa aktif dengan nomor KTP tersebut.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Penyewa</title>
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cari Penyewa</div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="ktp">No KTP</label>
                                <input type="text" name="ktp" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Cari</button>
                            <a href="operator.php" class="btn btn-secondary">Kembali ke Menu</a>
                        </form>
                        <?php if (!empty($message)): ?>
                            <div class="alert alert-warning mt-3"><?php echo $message; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($rentals)): ?>
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                       
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Pembayaran</th>
                                        <th>Waktu Peminjaman</th>
                                        <th>Biaya Tambahan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rentals as $rental): ?>
                                    <tr>
                                
                                        <td><?php echo $rental['name']; ?></td>
                                        <td><?php echo $rental['address']; ?></td>
                                        <td><?php echo $rental['payment']; ?></td>
                                        <td><?php echo $rental['rented_at']; ?></td>
                                        <td><?php echo $rental['additional_payment']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
