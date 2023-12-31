<?php
require '../Db/connection.php';
session_start();

if (isset($_POST['submit'])) {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    $database = new connection(); 
    try {
        $conn = $database->getConnection();
        $select_sql = "SELECT * FROM staff WHERE user_name = :user_name";
        $stmt = $conn->prepare($select_sql);
        $stmt->bindParam(':user_name', $user_name);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($user_password, $user['user_hashpassword'])) {
                $_SESSION['user_name'] = $user['user_name']; 
                header('location: Staff_dashbord.php');
                exit();
            } else {
                $_SESSION['error'] = 'Incorrect password.';
                header('location: Staff_login.php'); 
                exit();
            }
        } else {
            $_SESSION['error'] = 'User not found.';
            header('location: Staff_login.php'); 
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
