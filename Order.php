<?php
class Order {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

<<<<<<< HEAD

=======
    // Fetch all orders with specific statuses
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
    public function fetchAllOrders() {
        $stmt = $this->pdo->query("SELECT * FROM orders WHERE status IN ('pending', 'in_progress')");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

<<<<<<< HEAD
=======
    // Fetch a specific order by its ID
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
    public function fetchOrderById($orderId) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

<<<<<<< HEAD
    
=======
    // Fetch orders based on their status
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
    public function fetchOrdersByStatus($status) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE status = :status");
        $stmt->execute(['status' => $status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

<<<<<<< HEAD

=======
    // Fetch available drivers
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
    public function fetchAvailableDrivers() {
        $stmt = $this->pdo->query("SELECT id, name FROM drivers WHERE status = 'available'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

<<<<<<< HEAD

=======
    // Fetch orders that are completed or canceled
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
    public function fetchHistoryOrders() {
        $stmt = $this->pdo->query("SELECT * FROM orders WHERE status IN ('delivered', 'canceled')");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

<<<<<<< HEAD
=======
    // Fetch orders by a specific client
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
    public function fetchOrdersByClient($clientId) {
        $stmt = $this->pdo->prepare('SELECT * FROM orders WHERE client_id = :client_id');
        $stmt->execute(['client_id' => $clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

<<<<<<< HEAD
=======
    // Create a new order
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
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

<<<<<<< HEAD
    public function deleteOrder($orderId) {
        $stmt = $this->pdo->prepare("DELETE FROM orders WHERE id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->rowCount(); 
    }

    public function fetchOrdersByDriver($driverId) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE driver_id = :driver_id");
        $stmt->execute(['driver_id' => $driverId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOrderStatus($orderId, $newStatus) {
        $stmt = $this->pdo->prepare("UPDATE orders SET status = :status WHERE id = :order_id");
        $stmt->execute([
            'status' => $newStatus,
            'order_id' => $orderId
        ]);
        return $stmt->rowCount(); 
    }
}
=======
    // Delete an order by its ID
    public function deleteOrder($orderId) {
        $stmt = $this->pdo->prepare("DELETE FROM orders WHERE id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->rowCount(); // Return the number of affected rows
    }
}
?>
>>>>>>> ac3817fc5fc26c70f596b0f77614006c0236d30a
