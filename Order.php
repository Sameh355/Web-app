<?php
class Order {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fetch all orders with specific statuses
    public function fetchAllOrders() {
        $stmt = $this->pdo->query("SELECT * FROM orders WHERE status IN ('pending', 'in_progress')");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch a specific order by its ID
    public function fetchOrderById($orderId) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch orders based on their status
    public function fetchOrdersByStatus($status) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE status = :status");
        $stmt->execute(['status' => $status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch available drivers
    public function fetchAvailableDrivers() {
        $stmt = $this->pdo->query("SELECT id, name FROM drivers WHERE status = 'available'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch orders that are completed or canceled
    public function fetchHistoryOrders() {
        $stmt = $this->pdo->query("SELECT * FROM orders WHERE status IN ('delivered', 'canceled')");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch orders by a specific client
    public function fetchOrdersByClient($clientId) {
        $stmt = $this->pdo->prepare('SELECT * FROM orders WHERE client_id = :client_id');
        $stmt->execute(['client_id' => $clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new order
    public function createOrder($clientId, $trackingNumber, $orderName, $address, $pickupAddress, $contactNumber, $deliveryTimeWeekday, $deliveryTimeWeekend) {
        $stmt = $this->pdo->prepare('INSERT INTO orders (client_id, tracking_number, order_name, address, pickup_address, contact_number, delivery_time_weekday, delivery_time_weekend, status) 
                                      VALUES (:client_id, :tracking_number, :order_name, :address, :pickup_address, :contact_number, :delivery_time_weekday, :delivery_time_weekend, :status)');
        $stmt->execute([
            'client_id' => $clientId,
            'tracking_number' => $trackingNumber,
            'order_name' => $orderName,
            'address' => $address,
            'pickup_address' => $pickupAddress,
            'contact_number' => $contactNumber,
            'delivery_time_weekday' => $deliveryTimeWeekday,
            'delivery_time_weekend' => $deliveryTimeWeekend,
            'status' => 'pending'
        ]);
    }

    // Delete an order by its ID
    public function deleteOrder($orderId) {
        $stmt = $this->pdo->prepare("DELETE FROM orders WHERE id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->rowCount(); // Return the number of affected rows
    }
}
?>