<?php
require_once '../Db/connection.php'; 
include './admin_header.php';
session_start(); 

if (isset($_POST['add'])){

    $name = $_POST['name'];
    $description = $_POST['description'];
    $connection = new connection();
    $conn = $connection->getConnection();
    $sql = "INSERT INTO offer_promoction (name, description) VALUES (:name, :description)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
        $_SESSION['success'] = 'offer promoction added successfully';
        header('location:manage_offer_promoction.php');

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    $conn = null;
}
?>
