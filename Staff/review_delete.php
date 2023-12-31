<!-- delete.php -->
<?php
require '../Db/connection.php'; 
if (isset($_POST['delete'])) {
    if (isset($_POST['id'])) {
        try {
            require '../Db/connection.php'; 
            $connectionObj = new connection();
            $conn = $connectionObj->getConnection();
            $sql = "DELETE FROM feedback WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $_POST['id']);
            $stmt->execute();
            header('Location:manage_customer_review.php');
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
        }
    }
}
?>
