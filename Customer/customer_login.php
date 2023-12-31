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
    <h2>Login</h2>
    <form action="./customer_login_inc.php" method="post">
      <div class="textbox">
        <input type="email" placeholder="Enter your email" name="customer_email" required>
      </div>
      <div class="textbox">
        <input type="password" placeholder="Enter your Password" name="customer_password" required>
        <a href="./forgot_password.php" class="forgot-password">Forgot Password?</a>
      </div>
      <input type="submit" class="btn" value="Sign In" name="submit"> 
      <a href="./customer_registation.php" class="regtation">Create account</a>
    </form>     
  </div>

</body>
</html>



