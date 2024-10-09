<?php
session_start();
require_once 'config.php';
require_once 'Order.php';

<<<<<<< HEAD
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
=======
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'client') {
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
    header('Location: login.php');
    exit;
}

$orderObj = new Order($pdo);
<<<<<<< HEAD

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientName = $_POST['client_name'];
    $orderName = $_POST['order_name'];
    $status = $_POST['status'];
    $deliveryDate = $_POST['delivery_date'];

    $orderObj->createOrder($clientName, $orderName, $status, $deliveryDate);

    header('Location: admin_dashboard.php');
=======
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
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Create a New Order</title>
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: #fff;
            margin-top: 100px;
            max-width: 700px;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            font-size: 26px;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
        }
        .form-group label {
            font-weight: 500;
            color: #555;
=======
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
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
<<<<<<< HEAD
            font-weight: 600;
            padding: 10px 15px;
            font-size: 18px;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .form-control {
            height: calc(2.25rem + 10px);
            padding: 0.625rem 1.25rem;
            font-size: 16px;
            border-radius: 5px;
        }
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .form-control::placeholder {
            color: #999;
=======
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .logout-btn {
            margin-top: 10px;
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create a New Order</h2>
        <form method="POST">
            <div class="form-group">
<<<<<<< HEAD
                <label for="client_name">Client Name:</label>
                <input type="text" name="client_name" class="form-control" placeholder="Enter client's full name" required>
            </div>
            <div class="form-group">
                <label for="order_name">Order Name:</label>
                <input type="text" name="order_name" class="form-control" placeholder="Enter order description" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="delivered">Delivered</option>
                    <option value="canceled">Canceled</option>
                </select>
            </div>
            <div class="form-group">
                <label for="delivery_date">Delivery Date:</label>
                <input type="date" name="delivery_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Create Order</button>
        </form>
=======
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
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
    </div>
</body>
</html>
