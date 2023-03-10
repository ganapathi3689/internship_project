<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "internship_db";
//create connection

$conn = new mysqli($db_host,$db_user,$db_password,$db_name);
//check connection
if($conn->connect_error){
    die("connection failed");
}
else{
    // echo "connected";
}
if(!isset($_SESSION)){
	session_start();
}

if(isset($_SESSION['is_adminlogin'])){
$adminemail  = $_SESSION['admin_email'];
}
else{
	echo "<script> location.href='edu-tech/header.php';</script>";
}


              $query = "SELECT * FROM course ";
              $rows = mysqli_query($conn,$query);
              $totalrows = mysqli_num_rows($rows);

			  $query = "SELECT * FROM lesson ";
              $lessonrow = mysqli_query($conn,$query);
              $totallesson = mysqli_num_rows($lessonrow);

			  $query = "SELECT * FROM add_quiz ";
              $quizrow = mysqli_query($conn,$query);
              $totalquiz = mysqli_num_rows($quizrow);

			?>
<!Doctype HTML>
<html>
<head>
	<title>ADMIN</title>
	<link rel="stylesheet" href="dashboard.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>
	
	<div id="mySidenav" class="sidenav">
	<p class="logo"><span>E</span>du-tech</p>
	<!-- <img src="white_logo.png" alt="logo"> -->
	<a href="dashboard.php" class="icon-a" style="
    
    border: 3px solid #eeee;
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
	border-style: inset;
    
    "><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
	<a href="courses.php"class="icon-a"><i class="fa fa-book" style="font-size:24px"></i></i> &nbsp;&nbsp;Courses</a>
	<a href="lectures.php"class="icon-a"><i class="fa fa-youtube-play" style="font-size:24px"></i> &nbsp;&nbsp;Lessons</a>
	<a href="quiz.php"class="icon-a"><i class="fa fa-mortar-board" style="font-size:24px"></i> &nbsp;&nbsp;Quiz</a>
	<a href="#"class="icon-a"><i class="fa fa-credit-card" style="font-size:24px"></i> &nbsp;&nbsp;payment</a>
	<a href="#"class="icon-a"><i class="fa fa-key" style="font-size:24px"></i> &nbsp;&nbsp;Change password</a>
	<a href="logout.php"class="icon-a" name="logout" ><i class="fa fa-sign-out" style="font-size:24px"></i> &nbsp;&nbsp;Logout</a>
	</div>

</div>
<div id="main">
   
	<div class="head">
		<div class="col-div-6">
<span style="font-size:30px;font-weight:bold;cursor:pointer; color: rgb(0, 0, 0);" class="nav"  >Dashboard</span>

</div>
	
	<div class="col-div-6">
	<!-- <div class="profile">

		<img src="images/user.png" class="pro-img" />
		<p>Manoj Adhikari</p>
	</div> -->
</div>
	<div class="clearfix"></div>
</div>

	<div class="clearfix"></div>
	<br/>
	
	<div class="col-div-3">
		<div class="box">
			<p>0<?php echo $totalrows; ?><br/><span>Courses</span></p>
			<i class="fa fa-book box-icon" ></i>
		</div>
	</div>
	<div class="col-div-3">
		<div class="box">
			<p>0<?php echo $totallesson; ?><br/><span>Lessons</span></p>
			<i class="fa fa-youtube-play box-icon" ></i>
		</div>
	</div>
	<div class="col-div-3">
		<div class="box">
			<p>0<?php echo $totalquiz; ?><br/><span>Quiz</span></p>
			<i class="fa fa-mortar-board box-icon"></i>
		</div>
	</div>
	<div class="col-div-3">
		<div class="box">
			<p>00<br/><span>Tasks</span></p>
			<i class="fa fa-tasks box-icon"></i>
		</div>
	</div>
	<div class="clearfix"></div>
	<br/><br/>
	
</div> 




</body>
</html>