<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];  
    $deliveryTimeWeekday = $_POST['delivery_time_weekday'];
    $deliveryTimeWeekend = $_POST['delivery_time_weekend'];
    $deliveryDate = $_POST['delivery_date'];
    $sql = "INSERT INTO orders (client_id, delivery_time_weekday, delivery_time_weekend, delivery_date, status) 
            VALUES (:client_id, :delivery_time_weekday, :delivery_time_weekend, :delivery_date, 'pending')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':client_id' => $userId,
        ':delivery_time_weekday' => $deliveryTimeWeekday,
        ':delivery_time_weekend' => $deliveryTimeWeekend,
        ':delivery_date' => $deliveryDate,
    ]);

    header('Location: user_dashboard.php');
}
