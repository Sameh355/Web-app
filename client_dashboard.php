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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Client Dashboard</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
            .sidebar {
            width: 250px;
            background-color: #343a40;
            height: 100vh;
            padding: 20px;
            position: fixed;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .sidebar h3 {
            color: #ffc107;
            font-size: 1.5rem;
        }
        .sidebar h4 {
            font-size: 1.3rem;
            color: #ffc107;
        }
        .sidebar a {
            color: #ffffff;
            display: block;
            margin: 10px 0;
            font-size: 1.2rem;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
            padding: 10px;
            border-radius: 8px;
        }
        .sidebar input, .sidebar select, .sidebar button {
            width: 100%;
            margin: 15px 0;
            padding: 12px;
            border-radius: 8px;
            border: none;
            font-size: 1.1rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            color: #333;
        }
        .sidebar input::placeholder {
            color: #aaa;
        }
        .sidebar select {
            color: #343a40;
        }
        .sidebar button {
            background-color: #ffc107; 
            color: #343a40;
            font-weight: bold;
            font-size: 1.2rem; 
        }
        .sidebar button:hover {
            background-color: #e0a800; 
        }
        .main-content {
            margin-left: 270px;
            padding: 20px;
        }
        .btn-add-order {
            background-color: #28a745;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Menu</h3>
        <a href="client_dashboard.php">Dashboard</a>
        <a href="create_order.php">Create Order</a>
        <a href="logout.php">Logout</a>

        <h4>Search by Order ID:</h4>
        <input type="text" placeholder="Enter Order ID">
        <button class="btn btn-primary">Search</button>

        <h4>Filter by Status:</h4>
        <select>
            <option value="pending">Pending</option>
            <option value="delivered">Delivered</option>
            <option value="in_progress">In Progress</option>
            <option value="canceled">Canceled</option>
        </select>
        <button class="btn btn-primary">Filter</button>
    </div>

    <div class="main-content">
        <h2>Your Orders</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Tracking Number</th>
                    <th>Order Name</th>
                    <th>Status</th>
                    <th>Delivery Date</th>
                    <th>Delivery Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
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
                                <?php if ($order['status'] === 'pending'): ?>
                                    <form method="POST" action="delete_order.php" style="display:inline;">
                                        <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                                    </form>
                                <?php else: ?>
                                    <span class="text-success">Assigned</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">You do not have any orders. Please create an order.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="create_order.php" class="btn btn-success btn-add-order">Add Order</a>
    </div>
</body>
</html>
