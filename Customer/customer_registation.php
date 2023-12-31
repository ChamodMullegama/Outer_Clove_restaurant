<?php
include './customer_header.php'
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="icon" href="../Images/Outer clove.png" type="image/x-icon">
</head>

<body>

  <div class="login-box">
    <div class="aleart">

      <?php
      session_start();

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
    <h2>Registation</h2>
    <form action="./customer_registation_inc.php" method="post">
      <div class="textbox">
        <input type="text" placeholder="Enter your name" name="customer_name" required>
      </div>
      <div class="textbox">
        <input type="email" placeholder="Enter your email" name="customer_email" required>
      </div>
      <div class="textbox">
        <input type="password" placeholder="Password" name="customer_password" required>
      </div>
      <input type="submit" class="btn" value="Register" name="submit">
      <a href="./customer_login.php" class="regtation">sing up</a>
    </form>
  </div>
</body>
</html>