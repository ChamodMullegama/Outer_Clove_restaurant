<?php
include '../Db/connection.php';
include './admin_header.php';
$database = new connection();
try {
    $conn = $database->getConnection();


    $select_query = "SELECT * FROM orders";
    $stmt = $conn->prepare($select_query);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $totalAmount = 0;
    foreach ($orders as $order) {
        $totalAmount += $order['total_amount'];
    }

    if (count($orders) > 0) {
        echo '<table border="1" class="table">';
        echo '<p class="total-amount">Total Amount of All Orders: Rs. ' . $totalAmount . '.00</p>';
        echo '<tr><th>Order ID</th><th>Customer Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Order date and time</th><th>Total Amount</th></tr>';
        foreach ($orders as $order) {
            echo '<tr>';
            echo '<td>' . $order['order_id'] . '</td>';
            echo '<td>' . $order['customer_name'] . '</td>';
            echo '<td>' . $order['customer_email'] . '</td>';
            echo '<td>' . $order['customer_phone'] . '</td>';
            echo '<td>' . $order['customer_address'] . '</td>';
            echo '<td>' . $order['order_date'] . '</td>';
            echo '<td>' . 'Rs.' .  $order['total_amount'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
       

    } else {
        echo 'No orders found.';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
