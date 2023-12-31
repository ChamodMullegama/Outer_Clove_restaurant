<?php
require '../Db/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $database = new connection(); 

    try {
        $conn = $database->getConnection();

        $customer_name = $_POST['customer_name'];
        $customer_email = $_POST['customer_email'];
        $customer_phone = $_POST['customer_phone'];
        $customer_address = $_POST['customer_address'];
        $total_amount = $_POST['total_amount']; 

        $insert_query = "INSERT INTO orders (customer_name, customer_email, customer_phone, customer_address, total_amount)
        VALUES (:customer_name, :customer_email, :customer_phone, :customer_address, :total_amount)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':customer_email', $customer_email);
        $stmt->bindParam(':customer_phone', $customer_phone);
        $stmt->bindParam(':customer_address', $customer_address);
        $stmt->bindValue(':total_amount', $total_amount); 
        $stmt->execute();

        $_SESSION['success'] = 'payment added sususfully.';
        header("Location:checkout.php ");
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "Form not submitted!";
}
