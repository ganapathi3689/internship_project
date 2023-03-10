<?php
require("../dbconnection.php");
session_start();
//for login
if(isset($_POST['login'])){
    $query = "SELECT * FROM `sign_up` WHERE `email`='$_POST[email]'";
    $result= mysqli_query($conn,$query);
    if($result){
        if(mysqli_num_rows($result)==1){
       
            $result_fetch=mysqli_fetch_assoc($result);
            if(password_verify($_POST['password'],$result_fetch['password'])){
             //passsword matched
             $_SESSION['loggedin'] = true;
             $_SESSION['name'] =$result_fetch['name'];
             header("location:header.php");
            }else{
                // password incorrect
                echo "<script> alert('incorrect password');
                window.location.href='header.php';
                </script>
                
                ";
            }

        }else{
            echo "<script> alert('Email not registered');
            window.location.href='header.php';
            </script>
            
            ";
        }

    }else{
        echo "<script> alert('cannot run query');
    window.location.href='header.php';
    </script>
    
    ";
    }
}

//for registeration

if(isset($_POST['signup'])){
    $user_exist_query="SELECT * FROM `sign_up` WHERE `email` = '$_POST[email]'";
    $result = mysqli_query($conn,$user_exist_query);
    if($result){
     if(mysqli_num_rows($result)>0)//if email already registered;
     {
      $result_fetch=mysqli_fetch_assoc($result);
      echo "<script> alert('$result_fetch[email] , Email already registered');
      window.location.href='header.php';
      </script>";
    }
    else{
        $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
        $query = "INSERT INTO `sign_up`(`name`, `email`, `password`) VALUES ('$_POST[name]','$_POST[email]','$password')";
        if(mysqli_query($conn,$query)){
           #if data inserted
           echo "<script> alert('registration succesfull');
      window.location.href='header.php';
      </script>";

        }else{
            echo "<script> alert('cannot run query');
    window.location.href='header.php';
    </script>
    
    ";
        }
    }
}
    else{
    echo "<script> alert('cannot run query');
    window.location.href='header.php';
    </script>
    
    ";
    }

}
?>