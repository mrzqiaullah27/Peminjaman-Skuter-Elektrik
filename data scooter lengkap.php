<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Scooter Information</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #3498db;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    hr {
        border: 0;
        border-top: 1px solid #ccc;
        margin: 20px 0;
    }

    .search-form {
        margin-bottom: 20px;
    }

    .search-form input[type="text"] {
        padding: 10px;
        width: 200px;
    }

    .search-form input[type="submit"] {
        padding: 10px 20px;
        background-color: #3498db;
        border: none;
        color: white;
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
<button class="button back-button" onclick="goBack()">Back</button>
<div class="search-form">
    <form method="GET">
        <input type="text" name="search" placeholder="Search by ID or Number">
        <input type="submit" value="Search">
    </form>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Number</th>
        <th>Color</th>
        <th>Status</th>
    </tr>
    <?php
    include 'config.php';

$sql = "SELECT * FROM scooter";
$result = $conn->query($sql);

$scooters = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $scooters[] = $row;
    }
}

    // Check if $scooters variable is defined
    if (isset($scooters) && is_array($scooters)) {
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = $_GET['search'];
            $filteredScooters = array_filter($scooters, function($scooter) use ($search) {
                return strpos(strtolower($scooter['ID']), strtolower($search)) !== false ||
                       strpos(strtolower($scooter['number']), strtolower($search)) !== false;
            });

            foreach ($filteredScooters as $scooter) {
                echo "<tr>";
                echo "<td>" . $scooter['ID'] . "</td>";
                echo "<td>" . $scooter['number'] . "</td>";
                echo "<td>" . $scooter['color'] . "</td>";
                echo "<td>" . $scooter['status'] . "</td>";
                echo "</tr>";
            }
        } else {
            foreach ($scooters as $scooter) {
                echo "<tr>";
                echo "<td>" . $scooter['ID'] . "</td>";
                echo "<td>" . $scooter['number'] . "</td>";
                echo "<td>" . $scooter['color'] . "</td>";
                echo "<td>" . $scooter['status'] . "</td>";
                echo "</tr>";
            }
        }
    } else {
        echo "<tr><td colspan='4'>No scooters found.</td></tr>";
    }
    ?>
</table>

</body>
</html>
<script>
 function goBack() {
            window.location.href = "pimpinanTaman.php";
        }
</script>
