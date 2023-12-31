<?php
include './admin_header.php';
include '../Db/connection.php';

$database = new connection();

try {
   $conn = $database->getConnection();
   $select_sql = "SELECT * FROM gallery";
   $stmt = $conn->prepare($select_sql);
   $stmt->execute();
   $gallery_s = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
   echo 'Error: ' . $e->getMessage();
}


?>


<section class="add_product">
   <form action="./manage_gallery_inc.php" method="post" class="add-product-form" enctype="multipart/form-data">
      <div class="aleart">
         <?php


         if (isset($_SESSION['success'])) {
            echo '<div class="login-status-message-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
         }

         ?>
      </div>
      <h3>Add a new gallery</h3>
      <input type="file" name="gallery_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
      <input type="text" name="gallery_discrition" placeholder="description" class="box" require>
      <input type="submit" value="add the gallery" name="add_gallery" class="btn">
   </form>
</section>

<section class="view-gallery">
   <div class="product-cards">
      <?php
      foreach ($gallery_s as $gallery) {
         echo '<div class="product-card">';
         if (!empty($gallery['gallery_image'])) {
            echo '<img style="height:155px;" src="' . $gallery['gallery_image'] . '">';
         } else {
            echo '<img style="height: 155px; width: auto; max-width: 100%;" src="../uploaded_img/no_img.jpg">';
         }
         echo '<p>' . $gallery['gallery_discrition'] . '</p>';
         echo '<div class="card-footer">';
         echo '<form action="./delete_gallery.php" method="post" class=a"card_form">';
         echo '<input type="hidden" name="id" value="' . $gallery['id'] . '">';
         echo '<input type="hidden" name="delete_product" value="true">';
         echo '<button type="submit" class="delete-btn">Delete</button>';
         echo '</form>';
         echo '</div>';
         echo '</div>';
      }
      ?>

   </div>
</section>
</body>
</html>