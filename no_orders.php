<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$message = isset($_SESSION['message']) ? $_SESSION['message'] : 'No orders found.';
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Orders - Sameh Car Delivery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #F4F4F9;
            margin: 0;
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
            text-align: center;
        }
        .sidebar a {
            color: #ffffff;
            display: block;
            margin: 15px 0;
            font-size: 1.2rem;
            text-decoration: none;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar input, .sidebar select, .sidebar button {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            border: none;
            font-size: 1.1rem;
        }
        .sidebar button {
            background-color: #ffc107; 
            color: #343a40;
            font-weight: bold;
        }
        .sidebar button:hover {
            background-color: #e0a800; 
        }
        .message-container {
            margin-left: 270px; /* To align with the sidebar */
            padding: 50px 20px;
            text-align: center;
        }
        .message-container h2 {
            color: #333;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            margin-top: 15px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
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
        <form method="POST" action="search_order.php"> <!-- Update action -->
            <input type="text" name="search_order_id" placeholder="Enter Order ID" required>
            <button class="btn btn-primary" type="submit">Search</button>
        </form>

        <h4>Filter by Status:</h4>
        <form method="POST" action="filter_orders.php"> <!-- Update action -->
            <select name="filter_status">
                <option value="pending">Pending</option>
                <option value="delivered">Delivered</option>
                <option value="in_progress">In Progress</option>
                <option value="canceled">Canceled</option>
            </select>
            <button class="btn btn-primary" type="submit">Filter</button>
        </form>
    </div>

    <div class="message-container">
        <h2><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></h2>
        <a href="create_order.php" class="btn btn-custom">Create New Order</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
