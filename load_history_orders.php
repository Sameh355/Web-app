<?php
require_once 'config.php';
require_once 'Order.php';

$order = new Order($pdo);
$historyOrders = $order->fetchHistoryOrders();

foreach ($historyOrders as $order): ?>
    <tr>
        <td><?= $order['id']; ?></td>
        <td><?= $order['client_name']; ?></td>
        <td><?= $order['order_name']; ?></td>
        <td><?= $order['status']; ?></td>
        <td><?= $order['delivery_date']; ?></td>
        <td><?= $order['delivery_time_weekday']; ?></td>
    </tr>
<?php endforeach; ?>
