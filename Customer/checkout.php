<?php
include './customer_home.php';
include '../Db/connection.php';

$database = new connection(); 

try {
    $conn = $database->getConnection();
    if (!isset($_SESSION)) {
        session_start();
    }
    $select_sql = "SELECT * FROM cart WHERE `customer_name` = :customer_name";
    $stmt = $conn->prepare($select_sql);
    $stmt->bindParam(':customer_name', $_SESSION['customer_name']);
    $stmt->execute();
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_amount = 0;
    foreach ($cart_items as $cart) {
        $product_id = $cart['product_id'];
        $product_query = "SELECT * FROM product WHERE product_id = :product_id";
        $product_stmt = $conn->prepare($product_query);
        $product_stmt->bindParam(':product_id', $product_id);
        $product_stmt->execute();
        $product = $product_stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $subtotal = $cart['quantity'] * $product['Product_price'];
            $total_amount += $subtotal;
        }
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
    table {
        margin-top: 3%;
        
        width: 60%;
        margin-left: 20%;
        border-collapse: collapse;
        text-align: center;
        border: 1px solid black;
    }

    th{
        background-color: red;
    }
    th,
    td {
        padding: 8px;
        border: 1px solid black;
    }

    .checkout_img {
        width: 100px;
        height: auto;
        display: block;
        margin: 0 auto;
    }


    .section_checkout_topic {
    text-align: center;
    margin: 30px 0;
    margin-left: 10%;
    text-transform: capitalize;
    font-size: large;
    border: 1px solid black;
    border-radius: 10px;
    background-color: #871313;
    width: 80%;
  }

  .section_checkout_topic h1 {
    font-size: 32px;
    color: #333;
    margin-bottom: 10px;
    color: white;
  }

    .pay-now-btn {
        text-align: right;
        margin-top: 20px;
        margin-right: 74px;
    }

    .pay-now-btn button {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 60%;
        margin-left: 20%;
        margin-right: 17.5%;
    }

    .pay-now-btn button:hover {
        background-color: #45a049;
    }

    .delete_button{
        background-color: red;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
       
    }
.customer_from {
   
    margin-top: 20px;
    margin-bottom: 20px;
    width: 60%;
     margin-left: 20%;
    padding: 20px;
    border: 3px solid black;
    border-radius: 5px;

}

.customer-info {
    display: flex;
    flex-direction: column;
}

.customer-info label {
    margin-bottom: 5px;
    font-weight: bold;
}

.customer-info input[type="text"],
.customer-info input[type="email"],
.customer-info input[type="tel"], 
.customer-info input[type="submit"] {
    padding: 8px;
    margin-bottom: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

.customer-info input[type="submit"] {
background-color: #45a049;
color:white;
height: 40px;

}

.customer-info input[type="text"]:focus,
.customer-info input[type="email"]:focus,
.customer-info input[type="tel"]:focus {
    outline: none;
    border-color: #007bff; 
}

.btn-container {
    text-align: center;
    margin-top: 20px;
}

.btn-container button {
    padding: 10px 20px;
    margin: 0 5px;
    width: 60%;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    background-color: #007bff; 
    color: white;
    font-size: 16px;
    
}

.btn-container button:hover {
    background-color: #45a049; 
}
.login-status-message-success {
    font-weight: 300;
    color: #33cc33;
    margin-bottom: 15px;
    padding: 10px;
    border-radius: 5px;
    background-color: #f0fff0;
    transition: opacity 0.3s ease;
  }


   
</style>

<div class="section_checkout_topic">
  <h1>Checkout</h1>
</div>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart_items as $cart) : ?>
                <?php
                $product_id = $cart['product_id'];
                $product_query = "SELECT * FROM product WHERE product_id = :product_id";
                $product_stmt = $conn->prepare($product_query);
                $product_stmt->bindParam(':product_id', $product_id);
                $product_stmt->execute();
                $product = $product_stmt->fetch(PDO::FETCH_ASSOC);

                if ($product) {
                    $subtotal = $cart['quantity'] * $product['Product_price'];
                ?>
                    <tr>
                        <td><?php echo $product['Product_name']; ?></td>
                        <td><img src="<?php echo $product['Product_image']; ?>" alt="Product Image" class="checkout_img"></td>
                        <td><?php echo $cart['quantity']; ?></td>
                        <td>Rs.<?php echo $product['Product_price']; ?>.00</td>
                        <td>Rs.<?php echo number_format($subtotal, 2); ?></td>
                    </tr>
                <?php } ?>
            <?php endforeach; ?>

            <tr>
                <td colspan="4" align="right"><strong>Total:</strong></td>
                <td><strong>Rs.<?php echo number_format($total_amount, 2); ?></strong></td>
            </tr>
        </tbody>
    </table>
<div class="customer_from">
    <form method="post" action="payment_process.php" class="customer-info">
    <div class="aleart">
      <?php
      if (isset($_SESSION['success'])) {
        echo '<div class="login-status-message-success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']); 
      }
      ?>
    </div>
        <label for="customer_name">Name:</label>
        <input type="text" id="customer_name" name="customer_name" required><br><br>
        <label for="customer_email">Email:</label>
        <input type="email" id="customer_email" name="customer_email" required><br><br>
        <label for="customer_phone">Phone Number:</label>
        <input type="tel" id="customer_phone" name="customer_phone" required><br><br>
        <label for="customer_address">Address:</label>
        <input type="text" id="customer_address" name="customer_address" required><br><br>
        <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
        <input type="submit" value="pay" name="submit" >

    </form>
</div>
<br><br>

<?php
include '../footer.php';
?>
