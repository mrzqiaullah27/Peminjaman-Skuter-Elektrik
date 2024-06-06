<?php
include 'config.php';

// Menangani form submission untuk menambahkan pengguna
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';

    if (!empty($username) && !empty($password) && !empty($role)) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (username, password, role) VALUES ('$username', '$password_hashed', '$role')";
        if ($conn->query($sql) === TRUE) {
            echo "New user created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "All fields are required.";
    }
}

// Mengambil data pengguna dari database
$sql = "SELECT id, username, role FROM user";
$result = $conn->query($sql);

// Menyimpan data pengguna dalam array objek
$user = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_object()) {
        $user[] = $row;
    }
}
?>
<!DOCTYPE html>
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
            margin-top: 50px;
            width: 80%;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .button {
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            display: inline-block;
            margin-right: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .add-button {
            margin-bottom: 20px;
        }
        .form-container {
            display: none;
            margin-bottom: 20px;
        }
        .form-container.show {
            display: block;
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
    <title>Manage Users</title>
</head>
<body>
      <button class="button back-button" onclick="goBack()">Back</button>
    <h1>Manage Users</h1>
    <form action="data user.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="role">Role:</label><br>
        <select id="role" name="role" required>
            <option value="admin">Admin</option>
            <option value="pimpinan">Pimpinan</option>
            <option value="operator">Operator</option>
        </select><br>
        <input type="submit" value="Submit">
    </form>

    <h2>User List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
           <th>Action</th>
        </tr>
        <?php
        foreach ($user as $userdata) {
            echo "<tr id='row_$userdata->id'>";
            echo "<td>" . $userdata->id . "</td>";
            echo "<td>" . $userdata->username . "</td>";
            echo "<td id='role_$userdata->id'>" . $userdata->role . "</td>";
            echo "<td>";
            echo "<button class='button' onclick='editUser(" . $userdata->id . ")'>Edit</button>";
            echo "<button class='button' onclick='deleteUser(" . $userdata->id . ")'>Delete</button>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
 <script>
        function goBack() {
            window.location.href = "pimpinanTaman.php";
        }

        function editUser(userId) {
            var roleCell = document.getElementById("role_" + userId);
            var currentRole = roleCell.innerText;
            var roles = ["admin", "pimpinan", "operator"];

            // Create select element
            var selectRole = document.createElement("select");
            for (var i = 0; i < roles.length; i++) {
                var option = document.createElement("option");
                option.value = roles[i];
                option.text = roles[i];
                if (roles[i] === currentRole) {
                    option.selected = true;
                }
                selectRole.appendChild(option);
            }

            // Replace role cell content with select element
            roleCell.innerHTML = "";
            roleCell.appendChild(selectRole);

            // Create submit button
            var submitButton = document.createElement("button");
            submitButton.innerText = "Submit";
            submitButton.onclick = function() {
                updateUserRole(userId, selectRole.value);
            };

            // Append submit button to role cell
            roleCell.appendChild(submitButton);
        }

        function updateUserRole(userId, newRole) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_user_role.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Update role cell with new role
                        document.getElementById("role_" + userId).innerText = newRole;
                    } else {
                        alert('Error occurred while updating user role.');
                    }
                }
            };
            xhr.send("userId=" + userId + "&newRole=" + encodeURIComponent(newRole));
        }

        function deleteUser(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                // Send AJAX request to delete user
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_user.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Remove the row from the table after successful deletion
                            var row = document.getElementById("row_" + userId);
                            row.parentNode.removeChild(row);
                        } else {
                            alert('Error occurred while deleting user.');
                        }
                    }
                };
                xhr.send("userId=" + userId);
            }
        }
    </script>
