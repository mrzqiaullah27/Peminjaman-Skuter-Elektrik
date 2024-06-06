<?php
include 'config.php';
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tarif_per_jam = $_POST['tarif_per_jam'];
    $conn->query("UPDATE tarif_sewa SET tarif_per_jam='$tarif_per_jam' WHERE id=1");
    echo "Tarif berhasil diperbarui!";
}

$result = $conn->query("SELECT * FROM tarif_sewa WHERE id=1");
$tarif = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tarif Sewa Scooter</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }

        .hidden {
            display: none;
        }
        .back-button {
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Tarif Sewa Scooter Saat Ini: <span id="currentRate">Rp 10,000</span>/jam</h2>
        <button id="editButton">Edit Tarif</button>
        <div id="editForm" class="hidden">
            <form id="rateForm">
                <label for="newRate">Masukkan Tarif Baru (Rp):</label>
                <input type="number" id="newRate" name="newRate" min="5000" max="50000" required>
                <button type="submit">Submit</button>
            </form>
        </div>
        <p id="confirmation" class="hidden">Tarif sewa telah diperbarui.</p>
    </div>
    <button class="button back-button" onclick="goBack()">Back</button>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButton = document.getElementById("editButton");
            const editForm = document.getElementById("editForm");
            const confirmation = document.getElementById("confirmation");
            const currentRate = document.getElementById("currentRate");

            editButton.addEventListener("click", function() {
                editForm.classList.toggle("hidden");
            });

            const rateForm = document.getElementById("rateForm");
            rateForm.addEventListener("submit", function(event) {
                event.preventDefault();
                const newRate = document.getElementById("newRate").value;
                currentRate.textContent = "Rp " + newRate;
                confirmation.classList.remove("hidden");
                setTimeout(function() {
                    confirmation.classList.add("hidden");
                    editForm.classList.add("hidden");
                }, 2000);
            });
        });
          function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
