<?php
require '../Db/connection.php';
session_start();


if (isset($_POST['delete_customer'])) {

    $customer_id = $_POST['customer_id'];
    $database = new connection();
    $conn = $database->getConnection();

    try {

    
        $delete_sql = "DELETE FROM customer WHERE customer_id = :customer_id";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->execute();

        $_SESSION['success'] = 'customer deleted successfully';
        header('Location: manage_customer.php');
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    header('Location: manage_customer.php');
    exit();
}


?>