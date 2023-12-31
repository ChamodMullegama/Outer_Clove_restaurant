<?php
require '../Db/connection.php';
session_start();

if (isset($_POST['delete_user'])) {
    // Include the connection class
    

    // Get the product ID from the POST data
    $user_id = $_POST['user_id'];

    // Create an instance of the Database connection class
    $database = new connection();
    $conn = $database->getConnection();

    try {
        // Prepare SQL statement to delete the product
        $delete_sql = "DELETE FROM user_admin_staff WHERE user_id = :user_id";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bindParam(':user_id', $user_id);
        
        // Execute the deletion
        $stmt->execute();

        // Set success message and redirect back to the product management page
        $_SESSION['success'] = 'User deleted successfully';
        header('Location: manage_users.php');
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo 'Error: ' . $e->getMessage();
    }
} else {
    // Redirect to prevent direct access to this script
    header('Location: manage_users.php');
    exit();
}
?>
