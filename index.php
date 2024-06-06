<?php
include 'config.php';
session_start();

// Jika pengguna mencoba mendaftar
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_DEFAULT);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Periksa apakah username sudah ada dalam database
    $query_check_username = "SELECT * FROM user WHERE username='$username'";
    $result_check_username = $conn->query($query_check_username);

    if ($result_check_username->num_rows > 0) {
        echo "Username sudah ada!";
    } else {
        // Masukkan data pengguna ke dalam database
        $query_insert_user = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')";
        if ($conn->query($query_insert_user) === TRUE) {
            echo "Pengguna berhasil ditambahkan! Silakan login.";
        } else {
            echo "Error: " . $query_insert_user . "<br>" . $conn->error;
        }
    }
}

// Jika pengguna mencoba login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            if (isset($user['role'])) {
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == 'admin') {
                    header("Location: admin.php");
                    exit;
                } elseif ($user['role'] == 'pimpinan') {
                    header("Location: pimpinanTaman.php");
                    exit;
                } elseif ($user['role'] == 'operator') {
                    header("Location: operator.php");
                    exit;
                } else {
                    echo "Peran tidak valid!";
                    exit;
                }
            } else {
                echo "Peran pengguna tidak didefinisikan!";
                exit;
            }
        } else {
            echo "Username atau Password salah!";
        }
    } else {
        echo "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login & Register</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" name="login" value="Login">
    </form>

    <h2>Register</h2>
    <form method="post" action="">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        Role:
        <select name="role">
            <option value="admin">Admin</option>
            <option value="pimpinan">Pimpinan</option>
            <option value="operator">Operator</option>
        </select><br>
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>
 <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
