<?php
session_start();
if (!isset($_SESSION['user_name'])) {
  header('Location: Staff_login.php'); 
  exit();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Outer Clove Restaurant Staff</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../Images/Outer clove.png" type="image/x-icon">
  <link rel="stylesheet" href="../Styles/admin_header.css">
  <link rel="stylesheet" href="../Styles/manage_product.css">
  <link rel="stylesheet" href="../Styles/adminlogin.css">
  <link rel="stylesheet" href="../Styles/table.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>
  <nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
      <i class="fas fa-bars"></i>
    </label>
    <label class="logo">STAFF</label>
    <ul>
     <li><a href="./Staff_dashbord.php">Dashboard</a></li>
      <li><a href="./table_booking.php">view table booking</a></li>
      <li><a href="./view_customer_order.php">view customer orders</a></li>
      <li><a href="./view_dishes.php">view avalabel Dishes</a></li>
      <li><a href="./manage_customer_review.php">customer review</a></li>
      <?php
      if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
        echo '<li><a href="./Staff_logout.php"> ' . htmlspecialchars($_SESSION['user_name']),' / LOG OUT' . '</a></li>';
      }
    ?>
    </ul>
  </nav>

