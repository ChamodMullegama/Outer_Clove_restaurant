<?php

require '../Db/connection.php';
session_start();


if (isset($_POST['add_gallery'])) {
    
    $gallery_image = $_FILES['gallery_image']['name'];
    $gallery_image_tmp_name = $_FILES['gallery_image']['tmp_name'];
    $gallery_image_folder = '../uploaded_img/gallery/'.$gallery_image;
    $gallery_discrition = $_POST['gallery_discrition'];

    $database = new connection(); 

    try {
        $conn = $database->getConnection();

        $insert_sql = "INSERT INTO gallery ( gallery_image,gallery_discrition) VALUES (:gallery_image, :gallery_discrition)";
        $stmt = $conn->prepare($insert_sql);


        $stmt->bindParam(':gallery_image', $gallery_image_folder);
        $stmt->bindParam(':gallery_discrition', $gallery_discrition);


        move_uploaded_file($gallery_image_tmp_name, $gallery_image_folder);

        $stmt->execute();

        $_SESSION['success'] = 'image added sususfully.';
        header('location: manage_gallery.php');
        exit();
       
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}



?>


