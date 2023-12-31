<?php
require '../Db/connection.php';
session_start();


if (isset($_POST['delete_product'])) {
    $service_id = $_POST['service_id'];
    $database = new connection();
    $conn = $database->getConnection();

    try {

        $delete_sql = "DELETE FROM services WHERE service_id = :service_id";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bindParam(':service_id', $service_id);
        $stmt->execute();

        $_SESSION['success'] = 'Service deleted successfully';
        header('Location: manage_services.php');
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    header('Location: manage_services.php');
    exit();
}


?>