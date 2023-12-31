<?php
require '../Db/connection.php';

session_start();


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $database = new connection(); 

    try {
        $conn = $database->getConnection();

        $login_sql = "SELECT * FROM admin WHERE username = :username AND password = :password LIMIT 1";
        $stmt = $conn->prepare($login_sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $_SESSION['username'] = $row['username']; 
            header('location:admin_dashbord.php');
            exit();
        } else {
            $_SESSION['error'] = 'Invalid username or password.';
            header('location: admin_login.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Internal server error.';
        header('location: login.php');
        exit();
    }
}
?>