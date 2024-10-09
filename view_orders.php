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
$orders = $orderObj->fetchOrdersByClient($clientId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h2 {
            color: #007bff;
            margin-top: 20px;
        }
        .table {
            margin-top: 20px;
        }
        .btn-primary, .btn-danger {
            margin-top: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Orders</h2>

        <?php if (count($orders) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Tracking Number</th>
                        <th>Order Name</th>
                        <th>Status</th>
                        <th>Delivery Date</th>
                        <th>Delivery Time</th>
                        <th>Estimated Arrival</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= $order['id']; ?></td>
                            <td><?= $order['tracking_number']; ?></td>
                            <td><?= $order['order_name']; ?></td>
                            <td><?= $order['status']; ?></td>
                            <td>
                                <?= isset($order['delivery_date']) ? $order['delivery_date'] : 'Pending'; ?>
                            </td>
                            <td>
                                <?= isset($order['delivery_time_weekday']) ? $order['delivery_time_weekday'] : 'Pending'; ?>
                            </td>
                            <td>
                                <?= ($order['status'] !== 'pending' && $order['estimated_arrival']) ? $order['estimated_arrival'] : 'Pending'; ?>
                            </td>
                            <td>
                                <?php if ($order['status'] === 'pending'): ?>
                                    <form method="POST" action="delete_order.php" style="display:inline;">
                                        <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                                        <button type="submit" name="delete_order" class="btn btn-danger">Delete</button>
                                    </form>
                                <?php else: ?>
                                    <span>Order assigned, awaiting delivery</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                Sorry, you do not have any orders yet. Please create an order.
            </div>
            <a href="create_order.php" class="btn btn-primary">Create Order</a>
        <?php endif; ?>

        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
