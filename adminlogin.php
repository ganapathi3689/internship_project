<?php
require("dbconnection.php");

?>

    
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
 

