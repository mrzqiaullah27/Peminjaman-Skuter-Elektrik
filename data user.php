<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
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
</head>
<body>
    <div class="container">
        <h1>User Management</h1>
        <button class="button add-button" id="addUserBtn">Add User</button>
        <button class="button back-button" onclick="goBack()">Back</button>
        <div class="form-container" id="userFormContainer">
            <form id="userForm">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <button type="submit" class="button">Submit</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <!-- User data will be appended here -->
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('addUserBtn').addEventListener('click', function() {
            document.getElementById('userFormContainer').classList.add('show');
        });

        document.getElementById('userForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var username = this.username.value;
            var email = this.email.value;

            // Add user data to table
            var tableBody = document.getElementById('userTableBody');
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${tableBody.children.length + 1}</td>
                <td>${username}</td>
                <td>${email}</td>
                <td class="action-buttons">
                    <button class="button edit-button">Edit</button>
                    <button class="button delete-button">Delete</button>
                </td>
            `;
            tableBody.appendChild(newRow);

            // Clear form fields
            this.reset();

            // Hide form
            document.getElementById('userFormContainer').classList.remove('show');
        });

        // Delete user function
        function deleteUser(btn) {
            var row = btn.closest('tr');
            row.parentNode.removeChild(row);
            updateRowNumbers(); // Update the row numbers after deletion
        }

        // Event listener for delete buttons
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-button')) {
                deleteUser(event.target);
            }
        });

        // Function to update row numbers after deletion
        function updateRowNumbers() {
            var rows = document.querySelectorAll('#userTableBody tr');
            rows.forEach(function(row, index) {
                row.cells[0].textContent = index + 1;
            });
        }

        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
