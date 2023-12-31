<?php
require_once '../Db/connection.php';
session_start();

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $database = new connection();
    $conn = $database->getConnection();

    $sql = "DELETE FROM offer_promoction WHERE id = :id";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $_SESSION['success'] = 'Offer promoction deleted successfully';
        header('Location: manage_offer_promoction.php'); 
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    $conn = null; 
} else {
    header('Location: manage_offer_promoction.php'); 
}
?>
