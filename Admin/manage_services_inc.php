<?php

require '../Db/connection.php';
session_start();


if (isset($_POST['add_service'])) {
    
    $service_name = $_POST['service_name'];
    $service_image = $_FILES['service_image']['name'];
    $service_image_tmp_name = $_FILES['service_image']['tmp_name'];
    $service_image_folder = '../uploaded_img/services/'.$service_image;
    $service_description = $_POST['service_description'];

    $database = new connection(); 

    try {
        $conn = $database->getConnection();

   
        $insert_sql = "INSERT INTO services (service_name,service_image,service_description) VALUES (:service_name,:service_image,:service_description)";
        $stmt = $conn->prepare($insert_sql);


        $stmt->bindParam(':service_name', $service_name);
        $stmt->bindParam(':service_image', $service_image_folder);
        $stmt->bindParam(':service_description', $service_description);


        move_uploaded_file($service_image_tmp_name, $service_image_folder);

        $stmt->execute();

        $_SESSION['success'] = 'service added sususfully.';
        header('location:manage_services.php');
        exit();
       
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}



?>


