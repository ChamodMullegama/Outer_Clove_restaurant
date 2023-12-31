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
   <form action="./manage_offer_promoction_inc.php" method="post" class="add-product-form" enctype="multipart/form-data">
      <div class="aleart">
         <?php
         if (isset($_SESSION['success'])) {
            echo '<div class="login-status-message-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']); 
         }

         ?>
      </div>
      <h3>Add new offer or promoction</h3>
      <input type="text" name="name" placeholder="enter the product name" class="box" required>
      <input type="text" name="description" placeholder="enter the product description" class="box" required>
      <input type="submit" value="Add" name="add" class="btn">
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

<section>
<?php


$connection = new connection();
$conn = $connection->getConnection();
$sql = "SELECT * FROM offer_promoction";
try {
    $stmt = $conn->query($sql);
    $offer_promoction_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
$conn = null;
?>
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="success-message"><?php echo $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <table border="1" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($offer_promoction_data as $data) : ?>
                <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['name']; ?></td>
                    <td><?php echo $data['description']; ?></td>
                    <td>
                        <form method="post" action="./delete_offer_promoction.php">
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

</section>

</body>

</html>