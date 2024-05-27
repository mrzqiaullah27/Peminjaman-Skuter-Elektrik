<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $sql = "DELETE FROM rentals WHERE id='$delete_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Data berhasil dihapus.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM rentals WHERE returned_at IS NOT NULL";
$result = $conn->query($sql);
$returns = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $returns[] = $row;
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
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Lihat Data Pengembalian</div>
                    <div class="card-body">
                        <?php if (!empty($message)): ?>
                            <div class="alert alert-success"><?php echo $message; ?></div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID Sewa</th>
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
                                        <td><?php echo $return['id']; ?></td>
                                        <td><?php echo $return['ktp']; ?></td>
                                        <td><?php echo $return['name']; ?></td>
                                        <td><?php echo $return['address']; ?></td>
                                        <td><?php echo $return['payment']; ?></td>
                                        <td><?php echo $return['rented_at']; ?></td>
                                        <td><?php echo $return['additional_payment']; ?></td>
                                        <td><?php echo $return['returned_at']; ?></td>
                                        <td>
                                            <form method="post" action="" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                <input type="hidden" name="delete_id" value="<?php echo $return['id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <a href="menu.php" class="btn btn-secondary">Kembali ke Menu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
