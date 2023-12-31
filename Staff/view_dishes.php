<?php
require '../Db/connection.php';
include './Staff_header.php';

$database = new connection(); 

try {
    $conn = $database->getConnection();
    $select_sql = "SELECT * FROM product";
    $stmt = $conn->query($select_sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
<section class="table"> 
<table border="3">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price (Rs)</th>
            <th>Category</th>
            <th>Image</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product['Product_name']; ?></td>
            <td><?php echo $product['Product_price']; ?></td>
            <td><?php echo $product['Product_category']; ?></td>
            <td>
                <?php
                if (!empty($product['Product_image'])) {
                    echo '<img style="height:50px;" src="' . $product['Product_image'] . '">';
                 } else {
                    echo '<img style="height: 100x;" src="../uploaded_img/no_img.jpg">';
                 }
                ?>
            </td>
            <td><?php echo $product['product_discrition']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</section>


