<?php
require("dbconnection.php");

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Form |</title>
    <link rel="stylesheet" href="adminlogin.css">
  </head>
  <body>
    <div class="center">
      <h1>Login</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" name="admin_email" required>
          <span></span>
          <label>Admin E-mail</label>
        </div>
        <div class="txt_field">
          <input type="password"  name="admin_pass" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="pass">Forgot Password?</div>
        <input type="submit" value="Login" name="signin">
        <div class="signup_link">
          Welcome Back </a>
        </div>
      </form>
    </div>
    <?php
    if(isset($_POST['signin']))
    {
      $query = "SELECT * FROM `admin` WHERE `admin_email`='$_POST[admin_email]' AND `admin_pass`= '$_POST[admin_pass]' ";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)==1)
    {
      session_start();
      $_SESSION['is_adminlogin'] = true;
      $_SESSION['admin_email']= $_POST['admin_email'];
      header("location: dashboard.php");
    }else
    {
      echo "<script> alert('Incorrect password');</script>";
    }

    }
    ?>
  </body>
</html>
