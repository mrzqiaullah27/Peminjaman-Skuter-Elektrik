<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Scooter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
    
    <h1>Detail Scooter</h1>
    <table id="scooter-table">
        <thead>
            <tr>
                <th>Nomor Unik</th>
                <th>Warna</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here by JavaScript -->
        </tbody>
    </table>

    <!-- Modal for showing scooter details -->
    <div id="scooter-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Detail Scooter</h2>
            <p><strong>Nomor Unik:</strong> <span id="detail-nomor"></span></p>
            <p><strong>Warna:</strong> <span id="detail-warna"></span></p>
            <p><strong>Status:</strong> <span id="detail-status"></span></p>
            <p><strong>Berapa Kali Dipakai:</strong> <span id="detail-count"></span></p>
            <p><strong>Durasi Pakai (dalam jam):</strong> <span id="detail-duration"></span></p>
        </div>
    </div>
    <button class="button back-button" onclick="goBack()">Back</button>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const scooters = [
                {
                    nomor: "S001",
                    warna: "Merah",
                    status: "Available",
                    count: 15,
                    duration: 120
                },
                {
                    nomor: "S002",
                    warna: "Biru",
                    status: "In use",
                    count: 30,
                    duration: 240
                },
                {
                    nomor: "S003",
                    warna: "Hijau",
                    status: "Maintenance",
                    count: 5,
                    duration: 60
                }
            ];

            const tableBody = document.querySelector("#scooter-table tbody");
            scooters.forEach(scooter => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${scooter.nomor}</td>
                    <td>${scooter.warna}</td>
                    <td>${scooter.status}</td>
                `;
                row.addEventListener("click", () => showDetails(scooter));
                tableBody.appendChild(row);
            });
        });

        function showDetails(scooter) {
            document.getElementById("detail-nomor").innerText = scooter.nomor;
            document.getElementById("detail-warna").innerText = scooter.warna;
            document.getElementById("detail-status").innerText = scooter.status;
            document.getElementById("detail-count").innerText = scooter.count;
            document.getElementById("detail-duration").innerText = scooter.duration;

            const modal = document.getElementById("scooter-modal");
            modal.style.display = "block";

            const span = document.getElementsByClassName("close")[0];
            span.onclick = function() {
                modal.style.display = "none";
            };

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };
        }
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
