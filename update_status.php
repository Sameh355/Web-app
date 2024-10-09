<?php
session_start();
require 'config.php';
require 'Order.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'driver') {
    header('Location: login.php');
    exit;
}

$orderId = $_GET['id'];
$orderObj = new Order($pdo);
$order = $orderObj->fetchOrderById($orderId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newStatus = $_POST['status'];
    $orderObj->updateOrderStatus($orderId, $newStatus);
    header('Location: driver_dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order Status</title>
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
            color: #BE6DB7;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #BE6DB7;
            border-color: #BE6DB7;
        }
        .btn-primary:hover {
            background-color: #9d4e8b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Order Status</h2>
        <form method="POST">
            <div class="form-group">
                <label for="status">Select New Status:</label>
                <select name="status" class="form-control" required>
                    <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="in_progress" <?= $order['status'] === 'in_progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="delivered" <?= $order['status'] === 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                    <option value="canceled" <?= $order['status'] === 'canceled' ? 'selected' : ''; ?>>Canceled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Update Status</button>
        </form>
    </div>
</body>
</html>
