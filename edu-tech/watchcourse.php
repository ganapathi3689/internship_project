<?php 
require("../dbconnection.php");
?>
<!Doctype HTML>
<html>
<head>
	<title>ADMIN</title>
	<link rel="stylesheet" href="watchcourse.css?v=6"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Playfair+Display&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>
	
	<div id="mySidenav" class="sidenav">
        <div class="pad">
    <div class="logo">
    <img src="img/edutech_logo.png">
    </div>
    <hr>
    <!-- <p>List of Lessons</p> -->
   
	<ul id="playlist">
        <?php
        if(isset($_GET['course_id'])){
            $course_id = $_GET['course_id'];
            $sql = "SELECT * FROM lesson WHERE course_id = '$course_id' ";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                  echo '  <li movieurl=.'.$row['lesson_link'].'>'.$row['lesson_name'].' </li>';
                }
            }
            else
            echo '<script> alert("NO Videos Available "); 
            location.href="header.php";</script>';
        }
        ?>
       
        
    </ul>
    <p>Attempt Quiz to get certificate.</p>
    <a href="quizpage.php?course_id=<?php echo $course_id ;?>" class="btn">Start Quiz</a>
    </div>
</div>
<div id="main">
    
    <div class="bgr">
    <h2>Welcome to Python course</h2>
    </div>
   <video src="
   " id="videoarea" controls></video>
   <div class="content">
  <?php if(isset($_GET['course_id'])){
            $course_id = $_GET['course_id'];
            $sql1 = "SELECT * FROM course WHERE course_id = '$course_id' ";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();
           }
            ?>
    <table style="
    padding-top: -30%;
    position: relative;
    top: -30px;
">  
        <tr><td><h3>Course Details</h3></td></tr>
        <tr>
            <td><strong>Course Name :</strong></td>
            <td><?php echo $row1['course_name'] ;?></td>
        </tr><br>
        <tr>
        <td><strong>Course Description :</strong></td>
        <td><?php echo $row1['course_desc'] ;?></td>
        </tr><br>
        <tr>
            <td><strong>Course Duration :</strong></td>
            <td><?php echo $row1['course_duration'] ;?></td>
        </tr>
    </table>
    </div>
    
</div> 




<script src="custom.js"></script>
</body>
</html>