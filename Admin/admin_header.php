<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: admin_login.php'); 
  exit();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Outer Clove Restaurant Admin Pannele</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../Images/Outer clove.png" type="image/x-icon">
  <link rel="stylesheet" href="../Styles//admin_header.css">
  <link rel="stylesheet" href="../Styles//manage_product.css">
  <link rel="stylesheet" href="../Styles//adminlogin.css">
  <link rel="stylesheet" href="../Styles/table.css">
  <link rel="stylesheet" href="../Styles/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
  <nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
      <i class="fas fa-bars"></i>
    </label>
    <ul>
      <li><a href="./admin_dashbord.php">Dashboard</a></li>
      <li><a href="./manage_customer.php">Manage customer</a></li>
      <li><a href="./manage_users.php">Manage staff</a></li>
      <li><a href="./manage_product.php">Manage Dishes</a></li>
      <li><a href="./manage_order.php">Manage order</a></li>
      <li><a href="./manage_services.php">Manage Services</a></li>
      <li><a href="./manage_gallery.php">Manage Gallery</a></li>
      <li><a href="./manage_offer_promoction.php">promotions and offers</a></li>
      <?php
      if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        echo '<li><a href="admin_logout.php"> ' . htmlspecialchars($_SESSION['username']) . ' / LOG OUT</a></li>';
      }
      ?>
    </ul>
  </nav>