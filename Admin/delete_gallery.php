<?php
require '../Db/connection.php';
session_start();

if (isset($_POST['delete_product'])) {
    // Include the connection class
    

    // Get the product ID from the POST data
    $id = $_POST['id'];

    // Create an instance of the Database connection class
    $database = new connection();
    $conn = $database->getConnection();

    try {
        // Prepare SQL statement to delete the product
        $delete_sql = "DELETE FROM gallery WHERE id = :id";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bindParam(':id', $id);
        
        // Execute the deletion
        $stmt->execute();

        // Set success message and redirect back to the product management page
        $_SESSION['success'] = 'Gallery deleted successfully';
        header('Location: manage_gallery.php');
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo 'Error: ' . $e->getMessage();
    }
} else {
    // Redirect to prevent direct access to this script
    header('Location: manage_gallery.php');
    exit();
}


?>