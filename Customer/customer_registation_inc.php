<?php

require '../Db/connection.php';
include './send_mail.php';
session_start();


function generateOTP($length = 6)
{
    return rand(pow(10, $length - 1), pow(10, $length) - 1);
}

$customer_otp = generateOTP();
$_SESSION['customer_otp'] = $customer_otp;


if (isset($_POST['submit'])) {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_password = $_POST['customer_password'];
    $customer_passhash = password_hash($customer_password, PASSWORD_DEFAULT);
    $customer_otp = generateOTP();
    $_SESSION['customer_otp'] = $customer_otp;

    $database = new connection(); // Create an instance of your Database class

    try {
        $conn = $database->getConnection();


        $sql = "SELECT customer_email FROM customer WHERE customer_email = :customer_email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':customer_email', $customer_email);
        $stmt->execute();
        $result = $stmt->fetch();


        if ($result) {
            $_SESSION['erro'] = 'email is already exists';
            header("location:customer_registation.php");
        } else {
            // ...rest of the code

            $sql_insert = "INSERT INTO customer (customer_name, customer_email, customer_password, customer_otp) VALUES (:customer_name, :customer_email, :customer_password, :customer_otp)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bindParam(':customer_name', $customer_name);
            $stmt_insert->bindParam(':customer_email', $customer_email);
            $stmt_insert->bindParam(':customer_password', $customer_passhash);
            $stmt_insert->bindParam(':customer_otp', $customer_otp);
            $result_insert = $stmt_insert->execute();

            if ($result_insert) {
                // ...rest of the code
                $send_mail = new send_mail();
                $send_mail->send_mail($customer_name, $customer_email, $customer_otp);
                $_SESSION['success'] = 'Registration successful. Please verify your account with the OTP sent to your email.';
                header("location: customer_verify.php");
            } else {
                // ...rest of the code
                $_SESSION['error'] = 'Registration failed';
                header("location: customer_registation.php");
            }
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
