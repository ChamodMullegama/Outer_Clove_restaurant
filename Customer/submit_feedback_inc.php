<?php
require '../Db/connection.php'; 
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];

    try {
        $connectionObj = new connection();
        $conn = $connectionObj->getConnection();

        $sql = "INSERT INTO feedback (name, email, comment, rating) VALUES (:name, :email, :comment, :rating)";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindValue(':rating', $rating);

        $stmt->execute();
        
        $_SESSION['success'] = 'Rewive added sususfully.';
        header('location:submit_feedback.php');
        exit();
       
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>
