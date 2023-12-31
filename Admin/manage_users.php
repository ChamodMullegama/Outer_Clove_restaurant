<?php
include './admin_header.php';
require '../Db/connection.php';

$database = new connection();

try {
    $conn = $database->getConnection();

    $select_sql = "SELECT * FROM staff";
    $stmt = $conn->query($select_sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}



?>
<section class="add_product">
    <form action="./manage_users_inc.php" method="post" class="add-product-form" enctype="multipart/form-data">
    <div class="aleart">
         <?php



         if (isset($_SESSION['success'])) {
            echo '<div class="login-status-message-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']); 
         }

         ?>
      </div>
        <h3>Add a new user</h3>
        <input type="text" name="user_name" placeholder="enter the username" class="box" required>
        <input type="email" name="user_email" placeholder="enter email" class="box" required>
        <input type="text" name="user_password" min="0" placeholder="enter the password" class="box" required>
        <select name="user_type" class="box" required>
            <option value="Staff">Staff</option>
        </select>
        <input type="submit" value="Add new user" name="add_user" class="btn">
    </form>
</section>

<section class="table">
    <table border="3">
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>User Type</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['user_name']; ?></td>
                    <td><?php echo $user['user_email']; ?></td>
                    <td><?php echo $user['user_type']; ?></td>
                    <td>
                        <form method="POST" action="delete_user.php" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                            <button type="submit" name="delete_user">Delete</button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

</body>

</html>