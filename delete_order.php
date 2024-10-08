<?php
session_start();
require_once 'config.php';
require_once 'Order.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];
    $orderObj = new Order($pdo);
    
    // Check if the order exists
    $order = $orderObj->fetchOrderById($orderId);
    if (!$order) {
        echo json_encode(['status' => 'error', 'message' => 'Order does not exist.']);
        exit;
    }

    // Call deleteOrder method from the Order class
    $deletedRows = $orderObj->deleteOrder($orderId);

    // Check if the delete was successful
    if ($deletedRows > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Order deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete the order.']);
    }
    exit;
}
?>