<?php
include 'config.php';

// Menangani form submission untuk menambahkan scooter
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $number = isset($_POST['number']) ? $_POST['number'] : '';
    $color = isset($_POST['color']) ? $_POST['color'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    if (!empty($number) && !empty($color) && !empty($status)) {
        $sql = "INSERT INTO scooter (number, color, status) VALUES ('$number', '$color', '$status')";
        if ($conn->query($sql) === TRUE) {
            echo "New scooter added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "All fields are required.";
    }
}

// Mengambil data scooter dari database
$sql = "SELECT id, number, color, status FROM scooter";
$result = $conn->query($sql);

// Menyimpan data scooter dalam array objek
$scooters = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_object()) {
        $scooters[] = $row;
    }
}
?>
<!DOCTYPE html>
<style>
   body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    h1 {
      text-align: center;
    }

    #scooterForm {
      margin-bottom: 20px;
    }

    #scooterForm select, #scooterForm button {
      margin-right: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table, th, td {
      border: 1px solid black;
    }

    th, td {
      padding: 10px;
      text-align: left;
    }

    .green {
      color: green;
    }

    .blue {
      color: blue;
    }

    .red {
      color: red;
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Scooters</title>
</head>
<body>
    <button class="button back-button" onclick="goBack()">Back</button>
    <h1>Manage Scooters</h1>
    <form action="scooter.1.php" method="post">
        <label for="number">Number:</label><br>
        <input type="text" id="number" name="number" required><br>
        <label for="color">Color:</label><br>
        <input type="text" id="color" name="color" required><br>
        <label for="status">Status:</label><br>
        <select id="status" name="status" required>
            <option value="available">Available</option>
            <option value="rented">Rented</option>
            <option value="maintenance">Maintenance</option>
        </select><br>
        <input type="submit" value="Submit">
    </form>

      <h2>Scooter List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Number</th>
            <th>Color</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        foreach ($scooters as $scooter) {
            echo "<tr id='row_$scooter->id'>";
            echo "<td>" . $scooter->id . "</td>";
            echo "<td>" . $scooter->number . "</td>";
            echo "<td>" . $scooter->color . "</td>";
            echo "<td id='status_$scooter->id' class='" . $scooter->status . "'>" . $scooter->status . "</td>";
            echo "<td>";
            echo "<button class='button' onclick='editScooterStatus(" . $scooter->id . ")'>Edit Status</button>";
            echo "<button class='button' onclick='deleteScooter(" . $scooter->id . ")'>Delete</button>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <script>
        function goBack() {
            window.location.href = "admin.php";
        }

        function editScooterStatus(scooterId) {
            var statusCell = document.getElementById("status_" + scooterId);
            var currentStatus = statusCell.innerText;

            // Create select element
            var selectStatus = document.createElement("select");
            selectStatus.innerHTML = "<option value='available'>Available</option><option value='rented'>Rented</option><option value='maintenance'>Maintenance</option>";
            selectStatus.value = currentStatus;

            // Replace status cell content with select element
            statusCell.innerHTML = "";
            statusCell.appendChild(selectStatus);

            // Create submit button
            var submitButton = document.createElement("button");
            submitButton.innerText = "Submit";
            submitButton.onclick = function() {
                updateScooterStatus(scooterId, selectStatus.value);
            };

            // Append submit button to status cell
            statusCell.appendChild(submitButton);
        }

        function updateScooterStatus(scooterId, newStatus) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_scooter_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Update status cell with new status
                        var statusCell = document.getElementById("status_" + scooterId);
                        statusCell.innerText = newStatus;
                        statusCell.classList.remove(statusCell.classList.item(0)); // Remove previous class
                        statusCell.classList.add(newStatus); // Add new class
                    } else {
                        alert('Error occurred while updating scooter status.');
                    }
                }
            };
            xhr.send("scooterId=" + scooterId + "&newStatus=" + encodeURIComponent(newStatus));
        }

        function deleteScooter(scooterId) {
            if (confirm("Are you sure you want to delete this scooter?")) {
                // Send AJAX request to delete scooter
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_scooter.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Remove the row from the table after successful deletion
                            var row = document.getElementById("row_" + scooterId);
                            row.parentNode.removeChild(row);
                        } else {
                            alert('Error occurred while deleting scooter.');
                        }
                    }
                };
                xhr.send("scooterId=" + scooterId);
            }
        }
    </script>
</body>
</html>
