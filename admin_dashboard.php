<?php
session_start();
require_once 'config.php';
require_once 'Order.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$orderObj = new Order($pdo);

$orders = [];
$searchedOrder = null;
$searchedOrderId = null;

// Search orders by ID or filter by status
if (isset($_POST['search_order_id']) && !empty($_POST['search_order_id'])) {
    $searchedOrderId = $_POST['search_order_id'];
    $searchedOrder = $orderObj->fetchOrderById($searchedOrderId);

    if ($searchedOrder) {
        $orders[] = $searchedOrder;
    }
} else {
    if (isset($_POST['filter_status']) && !empty($_POST['filter_status'])) {
        $selectedStatus = $_POST['filter_status'];
        $orders = $orderObj->fetchOrdersByStatus($selectedStatus);
    } else {
        $orders = $orderObj->fetchAllOrders();
    }
}

$availableDrivers = $orderObj->fetchAvailableDrivers();
$historyOrders = $orderObj->fetchHistoryOrders(); // Ensure this is present
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Admin Dashboard</title>
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
            background-color: #fff;
            color: #333;
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
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Menu</h3>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>

        <h4>Search by Order ID:</h4>
        <form method="POST" action="">
            <input type="text" name="search_order_id" placeholder="Enter Order ID" value="<?= htmlspecialchars($searchedOrderId ?? '', ENT_QUOTES) ?>">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>

        <h4>Filter by Status:</h4>
        <form method="POST" action="">
            <select name="filter_status">
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="delivered">Delivered</option>
                <option value="canceled">Canceled</option>
            </select>
            <button class="btn btn-primary" type="submit">Filter</button>
        </form>
    </div>

    <div class="main-content">
        <h2>Admin Dashboard - Current Orders</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Client Name</th>
                    <th>Order Name</th>
                    <th>Status</th>
                    <th>Assign Driver</th>
                    <th>Delivery Time (Weekday)</th>
                    <th>Delivery Time (Weekend)</th>
                    <th>Delivery Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr id="order_row_<?= $order['id']; ?>">
                            <td><?= $order['id']; ?></td>
                            <td><?= $order['client_name']; ?></td>
                            <td><?= $order['order_name']; ?></td>
                            <td><?= $order['status']; ?></td>
                            <td>
                                <select name="driver_id_<?= $order['id']; ?>" id="driver_id_<?= $order['id']; ?>" class="form-control" required>
                                    <option value="">Select Driver</option>
                                    <?php foreach ($availableDrivers as $driver): ?>
                                        <option value="<?= $driver['id']; ?>"><?= $driver['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input type="time" id="delivery_time_weekday_<?= $order['id']; ?>" class="form-control" value="<?= isset($order['delivery_time_weekday']) ? $order['delivery_time_weekday'] : ''; ?>"></td>
                            <td><input type="time" id="delivery_time_weekend_<?= $order['id']; ?>" class="form-control" value="<?= isset($order['delivery_time_weekend']) ? $order['delivery_time_weekend'] : ''; ?>"></td>
                            <td><input type="date" id="delivery_date_<?= $order['id']; ?>" class="form-control" value="<?= isset($order['delivery_date']) ? $order['delivery_date'] : ''; ?>"></td>
                            <td>
                                <button type="button" class="btn btn-primary" onclick="assignDriver(<?= $order['id']; ?>)">Assign</button>
                                <button type="button" class="btn btn-danger" onclick="deleteOrder(<?= $order['id']; ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>History Orders</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Client Name</th>
                    <th>Order Name</th>
                    <th>Status</th>
                    <th>Delivery Date</th>
                    <th>Delivery Time</th>
                </tr>
            </thead>
            <tbody id="history_orders">
                <?php foreach ($historyOrders as $order): ?>
                    <tr>
                        <td><?= $order['id']; ?></td>
                        <td><?= $order['client_name']; ?></td>
                        <td><?= $order['order_name']; ?></td>
                        <td><?= $order['status']; ?></td>
                        <td><?= $order['delivery_date']; ?></td>
                        <td><?= $order['delivery_time_weekday']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    function assignDriver(orderId) {
        var driverId = document.getElementById('driver_id_' + orderId).value;
        var deliveryDate = document.getElementById('delivery_date_' + orderId).value;

        if (driverId && deliveryDate) {
            $.ajax({
                url: 'assign_driver.php',
                type: 'POST',
                data: {
                    order_id: orderId,
                    driver_id: driverId,
                    delivery_date: deliveryDate
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status === 'error') {
                        alert(res.message);
                    } else {
                        alert(res.message);
                        var historyRow = `
                            <tr>
                                <td>${res.order.id}</td>
                                <td>${res.order.client_name}</td>
                                <td>${res.order.order_name}</td>
                                <td>${res.order.status}</td>
                                <td>${res.order.delivery_date}</td>
                                <td>${res.order.delivery_time_weekday}</td>
                            </tr>
                        `;
                        $('#history_orders').append(historyRow);
                        $('#order_row_' + orderId).remove();
                    }
                },
                error: function() {
                    alert("Failed to assign driver");
                }
            });
        } else {
            alert('Please select a driver and delivery date.');
        }
    }

    function deleteOrder(orderId) {
        if (confirm('Are you sure you want to delete this order?')) {
            $.ajax({
                url: 'delete_order.php',
                type: 'POST',
                data: { order_id: orderId },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        alert('Order deleted successfully.');
                        $('#order_row_' + orderId).remove();
                    } else {
                        alert(res.message);
                    }
                },
                error: function() {
                    alert('Failed to delete the order.');
                }
            });
        }
    }
    </script>
</body>
</html>
