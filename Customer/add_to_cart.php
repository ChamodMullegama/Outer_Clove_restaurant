<?php

require '../Db/connection.php';

$customer_name = $_GET['customer_name'];
$product_id = $_GET['product_id'];
$quantity = 1;

$database = new connection(); 

try {
    $conn = $database->getConnection();

    $check_sql = "SELECT * FROM cart WHERE product_id = :product_id AND customer_name = :customer_name";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bindParam(':product_id', $product_id);
    $check_stmt->bindParam(':customer_name', $customer_name);
    $check_stmt->execute();
    $existing_entry = $check_stmt->fetch();

    if ($existing_entry) {
        $quantity += $existing_entry['quantity'];
        $update_sql = "UPDATE cart SET quantity = :quantity WHERE product_id = :product_id AND customer_name = :customer_name";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bindParam(':product_id', $product_id);
        $update_stmt->bindParam(':customer_name', $customer_name);
        $update_stmt->bindParam(':quantity', $quantity);
        $update_stmt->execute();
    } else {
        $insert_sql = "INSERT INTO cart (product_id, customer_name, quantity) VALUES (:product_id, :customer_name, :quantity)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bindParam(':product_id', $product_id);
        $insert_stmt->bindParam(':customer_name', $customer_name);
        $insert_stmt->bindParam(':quantity', $quantity);
        $insert_stmt->execute();
    }
    header('location: menu_and_order.php');
    exit();
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
