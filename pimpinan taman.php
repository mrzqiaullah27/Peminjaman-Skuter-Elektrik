<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scooter Rental Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #87CEFA;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #00BFFF;
            color: white;
            padding: 20px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        section {
            background-color: white;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #00BFFF;
        }

        button {
            background-color: #00BFFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #008CBA;
        }

        input[type="text"], input[type="date"] {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .scooter-detail {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .detail-label {
            font-weight: bold;
        }

        .detail-value {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        input[type="text"], input[type="date"] {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .date-label {
            margin-right: 10px;
        }

        #scooter-details-content, #transaction-report-scooter-content, #transaction-report-renter-content, #statistics-content {
            margin-top: 20px;
        }

        .chart-container {
            width: 100%;
            height: 400px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Manajemen Penyewaan Scooter</h1>
    </header>

    <main>
        <section id="scooter-details">
            <h2>Detail Scooter</h2>
            <input type="text" id="scooter-id" placeholder="Masukkan Nomor Unik Scooter">
            <button onclick="fetchScooterById()">Lihat Detail</button>
            <button onclick="fetchAllScooters()">Lihat Semua Scooter</button>
            <div id="scooter-details-content" class="scooter-detail"></div>
        </section>

        <section id="transaction-report-scooter">
            <h2>Laporan Transaksi per Scooter</h2>
            <label class="date-label">Dari:</label>
            <input type="date" id="start-date-scooter">
            <label class="date-label">Sampai:</label>
            <input type="date" id="end-date-scooter">
            <button onclick="fetchTransactionReportByScooter()">Lihat Laporan</button>
            <div id="transaction-report-scooter-content"></div>
        </section>

        <section id="transaction-report-renter">
            <h2>Laporan Transaksi per Penyewa</h2>
            <label class="date-label">Dari:</label>
            <input type="date" id="start-date-renter">
            <label class="date-label">Sampai:</label>
            <input type="date" id="end-date-renter">
            <button onclick="fetchTransactionReportByRenter()">Lihat Laporan</button>
            <div id="transaction-report-renter-content"></div>
        </section>

        <section id="statistics">
            <h2>Statistik Penyewaan</h2>
            <div class="chart-container">
                <canvas id="top-scooters-chart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="top-renters-chart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="top-areas-chart"></canvas>
            </div>
            <div id="statistics-content"></div>
        </section>
    </main>


    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // JavaScript untuk menangani pengambilan dan penampilan data
        });

        function fetchScooterById() {
            const scooterId = document.getElementById('scooter-id').value;
            const scooterDetails = [
                {
                    id: "S001",
                    warna: "Merah",
                    status: "Available",
                    count: 15,
                    duration: 120
                },
                {
                    id: "S002",
                    warna: "Biru",
                    status: "In use",
                    count: 30,
                    duration: 240
                },
                {
                    id: "S003",
                    warna: "Hijau",
                    status: "Maintenance",
                    count: 5,
                    duration: 60
                }
            ];
            const scooter = scooterDetails.find(s => s.id == scooterId);
            if (scooter) {
                displayScooterDetails(scooter);
            } else {
                displayScooterDetails({ error: 'Scooter tidak ditemukan' });
            }
        }

        function fetchAllScooters() {
            window.location.href = 'data scooter lengkap.html';
        }

        function displayScooterDetails(scooter) {
            const scooterDetailsContainer = document.getElementById('scooter-details-content');
            scooterDetailsContainer.innerHTML = '';

            if (scooter.error) {
                scooterDetailsContainer.textContent = scooter.error;
                return;
            }

            for (const [key, value] of Object.entries(scooter)) {
                const detailElement = document.createElement('div');
                detailElement.classList.add('detail-item');
                detailElement.innerHTML = `
                    <div class="detail-label">${key}</div>
                    <div class="detail-value">${value}</div>
                `;
                scooterDetailsContainer.appendChild(detailElement);
            }
        }
        function fetchTransactionReportByScooter() {
            const startDate = document.getElementById('start-date-scooter').value;
            const endDate = document.getElementById('end-date-scooter').value;
            const transactions = [
                { scooterId: 1, renter: 'User A', date: '2024-05-01', duration: '2 hours' },
                { scooterId: 2, renter: 'User B', date: '2024-05-02', duration: '3 hours' }
            ];
            displayData('transaction-report-scooter-content', transactions);
        }

        function fetchTransactionReportByRenter() {
            const startDate = document.getElementById('start-date-renter').value;
            const endDate = document.getElementById('end-date-renter').value;
            const transactions = [
                { renter: 'User A', scooterId: 1, date: '2024-05-01', duration: '2 hours' },
                { renter: 'User B', scooterId: 2, date: '2024-05-02', duration: '3 hours' }
            ];
            displayData('transaction-report-renter-content', transactions);
        }

        function fetchStatistics() {
            const statistics = {
                topScooters: ['Scooter A', 'Scooter B'],
                topRenters: ['User A', 'User B'],
                topAreas: ['Kecamatan 1', 'Kecamatan 2']
            };

            displayData('statistics-content', statistics);
            renderCharts(statistics);
        }

        function displayData(elementId, data) {
            const element = document.getElementById(elementId);
            element.innerHTML = `<pre>${JSON.stringify(data, null, 2)}</pre>`;
        }

        function renderCharts(statistics) {
            const ctxTopScooters = document.getElementById('top-scooters-chart').getContext('2d');
            const ctxTopRenters = document.getElementById('top-renters-chart').getContext('2d');
            const ctxTopAreas = document.getElementById('top-areas-chart').getContext('2d');

            new Chart(ctxTopScooters, {
                type: 'bar',
                data: {
                    labels: statistics.topScooters,
                    datasets: [{
                        label: 'Top Scooters',
                        data: [10, 5], // Example data, replace with real data
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            new Chart(ctxTopRenters, {
                type: 'bar',
                data: {
                    labels: statistics.topRenters,
                    datasets: [{
                        label: 'Top Renters',
                        data: [7, 3], // Example data, replace with real data
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            new Chart(ctxTopAreas, {
                type: 'bar',
                data: {
                    labels: statistics.topAreas,
                    datasets: [{
                        label: 'Top Areas',
                        data: [8, 6], // Example data, replace with real data
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

    </script>
</body>
</html>
