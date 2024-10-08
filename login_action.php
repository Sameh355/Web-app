<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND role = :role');
    $stmt->execute(['email' => $email, 'role' => $role]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        if ($user['role'] === 'admin') {
            header('Location: admin_dashboard.php');
        } elseif ($user['role'] === 'driver') {
            header('Location: driver_dashboard.php');
        } elseif ($user['role'] === 'client') {
            header('Location: client_dashboard.php');
        }
        exit;
    } else {
        echo "Invalid email, password, or role";
    }
}
?>