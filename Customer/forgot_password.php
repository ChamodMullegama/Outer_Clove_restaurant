<?php
include './customer_header.php'
?>
<!DOCTYPE html>
<html>

<head>
  <title>Login Form</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

  <div class="login-box">
    <div class="aleart">
      <?php
      session_start();
      if (isset($_SESSION['success'])) {
        echo '<div class="login-status-message-success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']); 
      }
      if (isset($_SESSION['error'])) {
        echo '<div class="login-status-message-error">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
      }

      ?>
    </div>
    <h2>Forgot Password</h2>
    <form action="./forgot_password_inc.php" method="post">
      <div class="textbox">
        <input type="email" placeholder="Enter your email" name="customer_email" required>
      </div>
      <input type="submit" class="btn" value="Get reset link" name="submit">
      <a href="./customer_registation.php" class="regtation">login</a>
    </form>
  </div>

</body>

</html>