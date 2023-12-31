
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Outer Clove Restaurant</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../Images/Outer clove.png" type="image/x-icon">
  <link rel="stylesheet" href="../Styles/customer_header.css">
  <link rel="stylesheet" href="../Styles/footer.css">
  <script src="./js/custamer.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
  <nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
      <i class="fas fa-bars"></i>
    </label>
    <label class="logo"><img src="../Images/Outer clove.png" alt="" width="30px" height="26px"> Outer Clove Restaurant</label>
    <ul>
      <li><a href="./extendable_home.php">HOME</a></li>
      <li><a href="./menu_and_order.php">MENU/ONLINE ORDER</a></li>
      <li><a href="./services.php">services</a></li>
      <li><a href="./gallery.php">GALLERY</a></li>
      <li><a href="./book.php">BOOK</a></li>
      <li><a href="./cart.php">CART</a></li>
      <li><a href="./submit_feedback.php">Review</a></li>
      <?php
      session_start();
      if (isset($_SESSION['customer_name']) && !empty($_SESSION['customer_name'])) {
        echo '<li><a href="./customer_logout.php"> ' . '<i class="fa fa-fw fa-user"></i>' . htmlspecialchars($_SESSION['customer_name']), ' / LOG OUT' . '</a></li>';
      }
      ?>
    </ul>
  </nav>







