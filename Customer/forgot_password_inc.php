<?php
require '../Db/connection.php';
include './send_mail.php';
session_start();

if (isset($_POST['submit'])) {
    $customer_email = $_POST['customer_email'];

    $database = new connection();

    try {
        $conn = $database->getConnection();
        $sql = "SELECT customer_email FROM customer WHERE customer_email = :customer_email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':customer_email', $customer_email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
               
        if ($result) {
            $token = bin2hex(random_bytes(32)); // Generate a random token
    
          
            $_SESSION['reset_token'] = $token;
            $_SESSION['reset_email'] = $customer_email;
    
            $reset_link = "http://localhost/Outer_Clove_restaurant/Customer/change_password.php?token=$token";
            $send_mail = new send_mail();
            $send_mail->sendmailresetpassword($customer_email, $reset_link);
          

        
        } else {
            $_SESSION['error'] = 'Email does not exist. Please register first.';
            header('location:forgot_password.php');
            exit();
        }
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
