<?php
session_start();
require_once 'config.php';
require_once 'Order.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$orderObj = new Order($pdo);

if (isset($_POST['order_id'], $_POST['driver_id'], $_POST['delivery_date'])) {
    $orderId = $_POST['order_id'];
    $driverId = $_POST['driver_id'];
    $deliveryDate = $_POST['delivery_date'];
    $result = $orderObj->assignDriverToOrder($orderId, $driverId, $deliveryDate);

    if ($result) {
        $assignedOrder = $orderObj->fetchOrderById($orderId);

        echo json_encode([
            'status' => 'success',
            'message' => 'Driver assigned successfully.',
            'order' => $assignedOrder
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to assign driver.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
}
?>