<?php
include './admin_header.php';
require '../Db/connection.php';

$database = new connection(); 
try {
    $conn = $database->getConnection();

    $sql = "SELECT * FROM customer";
    $stmt = $conn->query($sql);
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

?>

<section class="table">
    <table border="3">
        <thead>
            <tr>
                <th>Customer Id</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Customer Otp</th>
                <th>Customer Verify Status</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer) : ?>
                <tr>
                    <td><?php echo $customer['customer_id']; ?></td>
                    <td><?php echo $customer['customer_name']; ?></td>
                    <td><?php echo $customer['customer_email']; ?></td>
                    <td><?php echo $customer['customer_otp']; ?></td>
                    <td><?php echo $customer['customer_vstatus']; ?></td>
                    <td>
                        <form method="POST" action="delete_customer.php" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                            <input type="hidden" name="customer_id" value="<?php echo $customer['customer_id']; ?>">
                            <button type="submit" name="delete_customer">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

</body>

</html>