<?php
require '../Db/connection.php';
session_start();

if (isset($_POST['delete_product'])) {
    // Include the connection class
    

    // Get the product ID from the POST data
    $product_id = $_POST['product_id'];

    // Create an instance of the Database connection class
    $database = new connection();
    $conn = $database->getConnection();

    try {
        // Prepare SQL statement to delete the product
        $delete_sql = "DELETE FROM product WHERE Product_id = :product_id";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bindParam(':product_id', $product_id);
        
        // Execute the deletion
        $stmt->execute();

        // Set success message and redirect back to the product management page
        $_SESSION['success'] = 'dishes deleted successfully';
        header('Location: manage_product.php');
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo 'Error: ' . $e->getMessage();
    }
} else {
    // Redirect to prevent direct access to this script
    header('Location: product_management_page.php');
    exit();
}
?>
