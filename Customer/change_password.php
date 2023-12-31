<?php
include './customer_header.php'
?>

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
    <form action="./change_password_inc.php" method="post">
      <div class="textbox">
        <input type="password" placeholder="Enter new password" name="customer_new_password" required>
      </div>
      <div class="textbox">
        <input type="password" placeholder="Comform password" name="comfrom_customer_new_password" required>
      </div>
      <input type="submit" class="btn" value="Change password" name="submit">
      <a href="./customer_login.php" class="regtation">Login</a>
    </form>     
  </div>



</body>
</html>
