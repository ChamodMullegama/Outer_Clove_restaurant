<?php
include './customer_home.php';
require '../Db/connection.php';

$database = new connection(); 

try {
    $conn = $database->getConnection();

    $search_product_name = isset($_GET['search_product_name']) ? $_GET['search_product_name'] : '';
    $search_product_category = isset($_GET['search_product_category']) ? $_GET['search_product_category'] : '';

    $select_sql = "SELECT * FROM product WHERE 1=1"; 

    if (!empty($search_product_name)) {
        $select_sql .= " AND Product_name LIKE '%$search_product_name%'";
    }
    if (!empty($search_product_category)) {
        $select_sql .= " AND Product_category = '$search_product_category'";
    }

    $stmt = $conn->prepare($select_sql);


    $stmt = $conn->prepare($select_sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }


    .product-container {
        display: flex;
        justify-content: space-around;
  
        flex-wrap: wrap;
        margin: 20px auto;
        max-width: 1200px;
       

    }
    .product-card {
        width: 250px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        text-align: center;
        margin: 10px;
        border: 2px solid black;
        background-color: whitesmoke;
    }
    

    .product-card:hover{
     box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    transform: scale(1.1);
    transition: transform 0.4s ease-in-out;
    } 

    .product-card img {
        width: 100%;
        border-radius: 8px;
        margin-bottom: 10px;
        height: 180px;
        border: 3px solid black;
    }

    .product-title {
        font-size: 1.2em;
        margin-bottom: 5px;
    }

    .product-price {
        font-weight: bold;
        color: #007bff;
        margin-bottom: 15px;
    }

    .product-category {
        font-weight: bold;
        color: purple;
        margin-bottom: 15px;
    }

    .add-to-cart-btn {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .add-to-cart-btn:hover {
        background-color: #0056b3;
       
    }

    form {
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    input[type="text"],
    select {
        padding: 8px;
        margin-right: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        font-size: 16px;
        flex: 1;
    }

    select {
        min-width: 150px;
    }

    button[type="submit"],
    button#clearBtn {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    button#clearBtn {
        background-color: #f44336;
        color: #fff;
    }

    button#clearBtn:hover {
        background-color: #d32f2f;
    }

</style>

<center>
    <form method="GET" action="" style="margin-top: 15px;">
        <input type="text" name="search_product_name" placeholder="Search by Product Name">
        <select name="search_product_category">
            <option value="">Select Category</option>
            <?php
            $select_categories_sql = "SELECT DISTINCT Product_category FROM product";
            $stmt_categories = $conn->prepare($select_categories_sql);
            $stmt_categories->execute();
            $categories = $stmt_categories->fetchAll(PDO::FETCH_COLUMN);
            foreach ($categories as $category) {
                echo "<option value='$category'>$category</option>";
            }
            ?>
        </select>
        <button type="submit">Search</button>
        <button type="button" id="clearBtn">Clear</button>
    </form>
</center>

<div class="product-container">
    <?php
    foreach ($products as $product) {
    ?>
        <div class="product-card">
            <img src="<?php echo $product['Product_image']; ?>">
            <h3 class="product-title"><?php echo $product['Product_name']; ?></h3>
            <p class="product-category"><?php echo $product['Product_category']; ?></p>
            <p class="product-price">Rs. <?php echo $product['Product_price']; ?>.00</p>
            <a onclick="addItemToCart()" href="add_to_cart.php?customer_name=<?php echo isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : ''; ?>&product_id=<?php echo $product['Product_id']; ?>" class="add-to-cart-btn">Add to Cart</a>
        </div>
    <?php
    }
    ?>
</div>

<script>
    // JavaScript for form submission (Optional)
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const clearBtn = document.getElementById('clearBtn');

        clearBtn.addEventListener('click', function() {
            // Reset all form fields
            form.reset();
            form.submit();
        });
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const productName = form.elements['search_product_name'].value;
            const productCategory = form.elements['search_product_category'].value;

            form.submit();
        });
    });

    function addItemToCart(){
        alert("Item successfully added to cart");
    }
</script>

<?php
include '../footer.php';
?>