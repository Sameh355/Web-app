<?php
session_start();
require_once 'config.php';
require_once 'Order.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'client') {
    header('Location: login.php');
    exit;
}

$orderObj = new Order($pdo);
$clientId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trackingNumber = uniqid('TRK-'); 
    $orderName = $_POST['order_name'];
    $address = $_POST['address']; 
    $contactNumber = $_POST['contact_number'];
    $deliveryTimeWeekday = $_POST['delivery_time_weekday'];
    $deliveryTimeWeekend = $_POST['delivery_time_weekend'];
    $orderObj->createOrder($clientId, $trackingNumber, $orderName, $address, $contactNumber, $deliveryTimeWeekday, $deliveryTimeWeekend);

    header('Location: client_dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
        }
        h2 {
            color: #007bff;
            text-align: center;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .logout-btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create a New Order</h2>
        <form method="POST">
            <div class="form-group">
                <label for="order_name">Order Name:</label>
                <input type="text" name="order_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Enter Your Address:</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="text" name="contact_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="delivery_time_weekday">Preferred Delivery Time (Weekdays):</label>
                <input type="time" name="delivery_time_weekday" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="delivery_time_weekend">Preferred Delivery Time (Weekend):</label>
                <input type="time" name="delivery_time_weekend" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Create Order</button>
        </form>
        <form method="POST" action="logout.php">
            <button type="submit" class="btn btn-danger btn-block logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>
