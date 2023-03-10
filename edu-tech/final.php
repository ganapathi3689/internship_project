<?php
include '../dbconnection.php';
session_start();
$courseid=$_GET['course_id'];
$query = "SELECT * FROM quiz WHERE course_id = '$courseid' ";
    $total_questions = mysqli_num_rows(mysqli_query($conn,$query));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="final.css?v=2">
    <title>Document</title>
</head>
<body>
    <div class="background">
    <header>
        <div class="container">
            <h2>Certificate Quiz</h2>
        </div>
    </header>
    <main>
        <div class="container container2">
            <div class="content">
         <h2>Your Result</h2><br>
         <p>Your &nbsp;&nbsp;<strong>Score</strong> is &nbsp;<?php echo $_SESSION['score']; ?></p>
         
          <?php 
          if(((($_SESSION['score'])/$total_questions)*100)>=50){
            echo '<br><p style="color:green;">You are eligible to get Certificate</p>
            <br><a href="header.php" class="btn">Get Certificate</a>';
          }else{
            echo '<br><p style="color:red;">You are not eligible to get Certificate</p>
            <br><a href="header.php" class="btn">Exit</a>';
          }
          ?>
         
         <?php unset($_SESSION['score']); ?>
         </div>
        </div>
    </main>
    </div>
</body>
</html>