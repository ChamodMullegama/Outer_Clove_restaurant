<?php
require '../Db/connection.php';
session_start();

if (isset($_POST['submit'])) {
    $customer_email = $_POST['customer_email'];
    $customer_password = $_POST['customer_password'];

    $database = new connection(); // Create an instance of your Database class

    try {
        $conn = $database->getConnection();

        $login_sql = "SELECT * FROM customer WHERE customer_email = :customer_email LIMIT 1";
        $stmt = $conn->prepare($login_sql);
        $stmt->bindParam(':customer_email', $customer_email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Verify the entered password against the hashed password
            if (password_verify($customer_password, $row['customer_password'])) {
                // Check if the account is verified
                if ($row['customer_vstatus'] == '1') {
                    $_SESSION['customer_name'] = $row['customer_name']; // Optionally, store user_id in the session
                    header('location: extendable_home.php');
                    exit();
                } else {
                    $_SESSION['error'] = 'Please verify your account.';
                    header('location: customer_login.php');
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Invalid email or password.';
                header('location: customer_login.php');
                exit();
            }
        } else {
            $_SESSION['error'] = 'Invalid email or password.';
            header('location: customer_login.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Internal server error.';
        header('location: customer_login.php');
        exit();
    }
}
?>
