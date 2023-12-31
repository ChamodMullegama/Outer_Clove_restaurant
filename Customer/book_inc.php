<?php
require '../Db/connection.php';
session_start();

if (isset($_POST['submit'])) {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_phone = $_POST['customer_phone'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];
    $table_id = $_POST['table_id'];
    $guests = $_POST['guests'];
   
  

    $database = new connection(); 

    try {
        $conn = $database->getConnection();


        $insert_sql = "INSERT INTO booking(customer_name, customer_email, customer_phone, booking_date, booking_time, table_id, guests) VALUES (:customer_name, :customer_email, :customer_phone, :booking_date, :booking_time, :table_id, :guests)";
        $stmt = $conn->prepare($insert_sql);

        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':customer_email', $customer_email);
        $stmt->bindParam(':customer_phone', $customer_phone);
        $stmt->bindParam(':booking_date', $booking_date);
        $stmt->bindParam(':booking_time', $booking_time);
        $stmt->bindParam(':table_id', $table_id);
        $stmt->bindParam(':guests', $guests);
    
 

        $stmt->execute();
        $_SESSION['success'] = 'Table booking successful.';
        header('Location: book.php');
        exit();
    } catch (PDOException $e) {

        echo 'Error: ' . $e->getMessage();
    }
}
?>
