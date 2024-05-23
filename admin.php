<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100vh;
            background-color: linear-gradient(to right, #009579, #00b386, #00d093, #00eba0, #00ffad);
        }
        .dashboard-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 50px;
        }
        .dashboard-buttons a {
            display: block;
            width: 200px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            border: circular;
            border-radius: 10px;
            text-align: center;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .dashboard-buttons a:hover {
            background-color: #0056b3;
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
    <h1>Admin Dashboard</h1>
    <div class="dashboard-buttons">
        <a href="data user.php">Manage Users</a>
        <a href="scooter.php">Manage Scooters</a>
        <a href="tarif sewa.php">Edit Tarif Sewa</a>
    </div>
    <a class="logout-button" href="tampilan.php">Logout</a>
</body>
</html>
