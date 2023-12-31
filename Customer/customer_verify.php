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
        unset($_SESSION['success']); // Clear the session variable after displaying the message
    }
    if (isset($_SESSION['error'])) {
        echo '<div class="login-status-message-error">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']); // Clear the session variable after displaying the message
    } 

    ?>
    </div>
    <h2>Verify</h2>
    <form action="./customer_verify_inc.php" method="post">
      <div class="textbox">
        <input type="text" placeholder="Enter the otp code" name="customer_otp" required>
      </div>
      <input type="submit" class="btn" value="Verify" name="submit">
      <a href="./customer_registation.php" class="regtation">sing up</a>
    </form>     
  </div>

</body>
</html>



 
