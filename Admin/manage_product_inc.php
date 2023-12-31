<?php

require '../Db/connection.php';
session_start();

if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = '../uploaded_img/product/'.$product_image;
    $product_discrition = $_POST['product_discrition'];

    $database = new connection(); 

    try {
        $conn = $database->getConnection();
        $insert_sql = "INSERT INTO product (product_name, product_price, product_category, product_image, product_discrition) VALUES (:product_name, :product_price, :product_category, :product_image, :product_discrition)";
        $stmt = $conn->prepare($insert_sql);

    
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':product_price', $product_price);
        $stmt->bindParam(':product_category', $product_category);
        $stmt->bindParam(':product_image', $product_image_folder);
        $stmt->bindParam(':product_discrition', $product_discrition);

     
        move_uploaded_file($product_image_tmp_name, $product_image_folder);

        $stmt->execute();

        $_SESSION['success'] = 'Dishes added successfully.';
        header('location: manage_product.php');
        exit();
       
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}



?>