<?php
require '../Db/connection.php';
include './Staff_header.php';

function getAllBookings($conn)
{
    $sql = "SELECT * FROM booking";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $bookings;
}


if (isset($_GET['delete_id'])) {
    $database = new connection();
    $conn = $database->getConnection();
    $delete_id = $_GET['delete_id'];

    try {
        $delete_sql = "DELETE FROM booking WHERE booking_id = :delete_id";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bindParam(':delete_id', $delete_id);
        $stmt->execute();
        $_SESSION['success'] = 'Booking deleted successfully.';
        header('Location: table_booking.php'); 
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

$database = new connection();
$conn = $database->getConnection();
$bookings = getAllBookings($conn);
?>


<table border="1" class="table">
    <tr>
        <th>Booking_id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Date</th>
        <th>Time</th>
        <th>Table ID</th>
        <th>Guests</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($bookings as $booking) : ?>
        <tr>
            <td><?= $booking['booking_id']; ?></td>
            <td><?= $booking['customer_name']; ?></td>
            <td><?= $booking['customer_email']; ?></td>
            <td><?= $booking['customer_phone']; ?></td>
            <td><?= $booking['booking_date']; ?></td>
            <td><?= $booking['booking_time']; ?></td>
            <td><?= $booking['table_id']; ?></td>
            <td><?= $booking['guests']; ?></td>
            <div class="aleart">
 
 <?php
      
         if (isset($_SESSION['erro'])) {
             echo '<div class="login-status-message-error">' . $_SESSION['erro'] . '</div>';
             unset($_SESSION['erro']); 
         }
         if (isset($_SESSION['susess'])) {
             echo '<div class="login-status-message-success">' . $_SESSION['susess'] . '</div>';
             unset($_SESSION['susess']); 
         }
     ?>
 </div>
            <td>
                <a href="table_booking.php?delete_id=<?= $booking['booking_id']; ?>" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>