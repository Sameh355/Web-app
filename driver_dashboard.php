<?php
session_start();
require 'config.php';
require 'Order.php';

<<<<<<< HEAD
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'driver') {
=======
if ($_SESSION['role'] !== 'driver') {
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
    header('Location: login.php');
    exit;
}

$driverId = $_SESSION['user_id'];
$orderObj = new Order($pdo);
<<<<<<< HEAD
$orders = $orderObj->fetchOrdersByDriver($driverId);
=======
$orders = $orderObj->fetchAllOrders();
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            color: #BE6DB7;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .logout-container {
            text-align: right;
            margin-bottom: 20px;
        }
        .logout-btn {
            background-color: #C04A82;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        .logout-btn:hover {
            background-color: #9d3068;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #DC8449;
            color: white;
        }
        td {
            padding: 15px;
        }
        .btn-primary {
            background-color: #BE6DB7;
            border-color: #BE6DB7;
        }
        .btn-primary:hover {
            background-color: #9d4e8b;
            border-color: #9d4e8b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Driver Dashboard</h2>
        <div class="logout-container">
            <form method="POST" action="logout.php">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Client Name</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['id']); ?></td>
                        <td><?= htmlspecialchars($order['client_name'] ?? 'N/A'); ?></td>
                        <td><?= htmlspecialchars($order['address'] ?? 'N/A'); ?></td>
                        <td><?= htmlspecialchars($order['status']); ?></td>
                        <td><a href="update_status.php?id=<?= $order['id']; ?>" class="btn btn-primary btn-sm">Update Status</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
