<?php
session_start();
require '../Db/connection.php';

if (isset($_POST['submit'])) {
    $customer_new_password = $_POST['customer_new_password'];
    $confirm_password = $_POST['comfrom_customer_new_password'];
    $token = $_GET['token'];

    // Validate the token from the session
    if (
        isset($_SESSION['reset_token']) &&
        $_SESSION['reset_token'] === $token &&
        isset($_SESSION['reset_email'])
    ) {
        $_SESSION['error'] = 'Invalid or expired token';
        header('location:forgot_password.php ');
        exit();
    }

    // Check if passwords match
    if ($customer_new_password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match';
        header('location: change_password.php');
        exit();
    }

    // Retrieve the email associated with the token
    $customer_email = $_SESSION['reset_email'];

    // Update the user's password using PDO
    $database = new connection(); // Create an instance of your Database class

    try {
        $conn = $database->getConnection();
        $new_password_hash = password_hash($customer_new_password, PASSWORD_DEFAULT);

        $update_sql = 'UPDATE customer SET customer_password = :customer_new_password WHERE customer_email = :customer_email';
        $stmt = $conn->prepare($update_sql);
        $stmt->bindParam(':customer_new_password', $new_password_hash);
        $stmt->bindParam(':customer_email', $customer_email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['success'] = 'Password updated successfully. Please log in with your new password.';
            header('location:customer_login.php');
            exit();
        } else {
            $_SESSION['error'] = 'Failed to update password';
            header('location: forgot_password.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Oops, something went wrong: ' . $e->getMessage();
        header('location: forgot_password.php');
        exit();
    }
}
?>
