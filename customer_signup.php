<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $fullName = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'customer';
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
    $result = $stmt->execute([
        ':name' => $fullName,
        ':email' => $email,
        ':password' => $hashedPassword,
        ':role' => $role
    ]);
    
    if ($result) {
        header('Location: login.php');
        exit;
    } else {
        echo "Error: Could not register user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up as Customer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #F4F4F9;
        }
        .signup-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .signup-btn {
            background-color: #BE6DB7;
            color: white;
            padding: 12px;
            width: 100%;
            font-size: 18px;
            border-radius: 5px;
        }
        .signup-btn:hover {
            background-color: #C04A82;
        }
    </style>
</head>
<body>
<div class="signup-container">
    <h2>Sign Up as Customer</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="signup-btn" name="signup">Sign Up</button>
    </form>
</div>
</body>
</html>
