<?php
include './admin_header.php';
include '../Db/connection.php';

$database = new connection(); 

try {
   $conn = $database->getConnection();
   $select_sql = "SELECT * FROM services";
   $stmt = $conn->prepare($select_sql);
   $stmt->execute();
   $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
   echo 'Error: ' . $e->getMessage();
}

?>

<section class="add_product">
   <form action="./manage_services_inc.php" method="post" class="add-product-form" enctype="multipart/form-data">
      <div class="aleart">
         <?php
         if (isset($_SESSION['success'])) {
            echo '<div class="login-status-message-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']); 
         }

         ?>
      </div>
      <h3>Add new service</h3>
      <input type="text" name="service_name" placeholder="enter the product name" class="box" required>
      <input type="file" name="service_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
      <input type="text" name="service_description" placeholder="enter the product description" class="box" required>
      <input type="submit" value="Add" name="add_service" class="btn">
   </form>

</section>


<script>
    function confirmDelete(serviceId) {
        var deleteConfirmed = confirm("Are you sure you want to delete this service?");
        if (deleteConfirmed) {
            document.getElementById("deleteForm_" + serviceId).submit();
        }
    }
</script>

<section class="view-products">
   <div class="product-cards">
      <?php
      foreach ($services as $service) {
         echo '<div class="product-card">';
         if (!empty($service['service_image'])) {
            echo '<img style="height:155px;" src="'. $service['service_image'] . '">';
         } else {
            echo '<img style="height: 155px; width: auto; max-width: 100%;" src="../uploaded_img/no_img.jpg">';
         }
         echo '<h4>' . $service['service_name'] . '</h4>';
         echo '<p>' . $service['service_description'] . '</p>'.'<br>';
         echo '<form id="deleteForm_' . $service['service_id'] . '" action="./delete_services.php" method="post" class="card_form">';
         echo '<input type="hidden" name="service_id" value="' . $service['service_id'] . '">';
         echo '<input type="hidden" name="delete_product" value="true">';
         echo '<button type="button" onclick="confirmDelete(' . $service['service_id'] . ')" class="delete-btn">Delete</button>';
         echo '</form>';
         echo '</div>'; 
      }
      ?>

   </div>
</section>

</body>

</html>