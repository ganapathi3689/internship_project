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
    echo "connected";
}
//start session
if(!isset($_SESSION)){
	session_start();
}
//cannot acces without login
if(isset($_SESSION['is_adminlogin'])){
$adminemail  = $_SESSION['admin_email'];
}
else{
	echo "<script> location.href='adminlogin.php';</script>";
}

if(isset($_REQUEST['coursesubmitbtn'])){
  //checking for empty fields
if(($_REQUEST['course_name'] == "")||($_REQUEST['course_desc'] == "")||($_REQUEST['course_author'] == "")||
($_REQUEST['course_duration'] == "")||($_REQUEST['course_price'] == "")||($_REQUEST['course_original_price'] == "")){

  $msg =' 
<script>
alert("Fill all the fields");
</script>';
}
else {
  $course_name = $_REQUEST['course_name'];
  $course_desc = $_REQUEST['course_desc'];
  $course_author = $_REQUEST['course_author'];
  $course_duration = $_REQUEST['course_duration'];
  $course_price = $_REQUEST['course_price'];
  $course_original_price = $_REQUEST['course_original_price'];
  //img upload
  $course_image = $_FILES['course_img']['name'];
  $course_image_temp =$_FILES['course_img']['tmp_name'];
  $img_folder = './image/courseimg/'.$course_image;
  move_uploaded_file($course_image_temp,$img_folder);

  $sql = "INSERT INTO course ( course_name, course_desc, course_author,course_img, course_duration, course_price, course_original_price) VALUES ('$course_name', '$course_desc',
  '$course_author', '$img_folder', '$course_duration', '$course_price','$course_original_price')"; 
  if($conn->query($sql) == TRUE)
  {
//     $msg ='<div class="warning"  >
//   <h3 style="text-align: center;
//   border: 1px solid green;
//  color: green;
//  background-color: #b7e3b7; width:150%;">Course Added Succesfully</h3></div>';
$msg =' 
<script>
alert("course added succesfully");
</script>';
  }
  else{
  //   $msg ='<div class="warning"  >
  //   <h3 style="text-align: center;
  //   border: 1px solid red;
  //  color: red;
  //  background-color: #ff72724f">Unable to add Course</h3></div>';
  $msg = '<script>
alert("Unable to add Course");
</script>';
  }
}
}
?>
<!Doctype HTML>
<html>
<head>
	<title>ADMIN</title>
	<link rel="stylesheet" href="courses.css" type="text/css"/>
	
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
</head>


<body>
	
	<div id="mySidenav" class="sidenav">
	<p class="logo"><span>E</span>du-tech</p>
  
	<a href="dashboard.php" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
	<a href="courses.php"class="icon-a"style="
    
    border: 3px solid #eeee;
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    border-style: inset;
    "><i class="fa fa-book" style="font-size:24px"></i> &nbsp;&nbsp;Courses</a>
	<a href="lectures.php"class="icon-a"><i class="fa fa-youtube-play" style="font-size:24px"></i> &nbsp;&nbsp;Lessons</a>
	<a href="quiz.php"class="icon-a"><i class="fa fa-mortar-board" style="font-size:24px"></i> &nbsp;&nbsp;Quiz</a>
	<a href="#"class="icon-a"><i class="fa fa-credit-card" style="font-size:24px"></i> &nbsp;&nbsp;payment</a>
	<a href="#"class="icon-a"><i class="fa fa-key" style="font-size:24px"></i> &nbsp;&nbsp;Change password</a>
	<a href="logout.php"class="icon-a" name="logout" ><i class="fa fa-sign-out" style="font-size:24px"></i> &nbsp;&nbsp;Logout</a>

</div>

<div id="main" style=" overflow: scroll;
    display: block;
    height: 100%;">
  <div class="main1" >
   <div class="top" style="
   display: flex;
   justify-content: space-between;
    ">
    <h1>List of Courses :</h1>
    <?php if(isset($msg)){ echo $msg;} ?>
    <a  id="button" class="button">Add</a>
   </div>
	<!-- display Data -->
   <?php
        $sql ="SELECT * FROM course";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
        ?>
    <table style="color: black;" class="content-table">
        <thead>
          <tr>
            <th>Course ID</th>
            <th>Name</th>
            <th>Author</th>
            <th>Edit/Delete</th>
          </tr>
        </thead>
       
        <tbody>
         <?php while($row = $result->fetch_assoc()){ ?>
          <tr>
            <td><?php echo $row['course_id']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td><?php echo $row['course_author']; ?></td>
            <td>
            <button type="submit" class="btn" name="view" value="view">
              <i class='fa fa-pencil-square-o' style='font-size:25px'></i>
            </button>&nbsp;&nbsp;
            <form method="POST" style="display:inline;">
            <input type="hidden" name="id" value=<?php echo $row['course_id']; ?>>
            <button type="submit" class="btn" name="delete" value="delete">
              <i class="fa fa-trash-o" style="font-size:25px;"></i>
            </button>
            </form>
          </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      </div>
   <?php   }  else{
         echo "0 results";
         }
         ?>
   
      
      <div class="bg-model">
        <div class="model-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="container">
                  <h1>Add New Course</h1>
                  <p>Please fill in this form to add new course.</p>
                  <hr>
              
                  <label for="course name"><b>Course Name</b></label>
                  <input type="text" placeholder="Enter The New Course Name" name="course_name" id="course name" >
              
                  <label for="course desp"><b>Course Description</b></label>
                  <input type="text" placeholder="Enter New Course Description" name="course_desc" id="course desc" >
              
                  <label for="auth"><b>Author</b></label>
                  <input type="text" placeholder="Enter Author Name" name="course_author" id="auth" >
                  
                   <label for="course dur"><b>Course Duration</b></label>
                  <input type="text" placeholder="Enter The New Course Duration" name="course_duration" id="course dur" >

                  <label for="course price"><b>Course Price</b></label>
                  <input type="number" placeholder="Enter The New Course Price" name="course_price" id="course  price" >
                  
                   <label for="course orginal price"><b>Course Orginal Price</b></label>
                  <input type="number" placeholder="Enter The New Course Orginal Price" name="course_original_price" id="course original price" >
                  
                  <label for="course image"><b>Course Image</b></label>
                  <input type="file" placeholder="Choose The Coure Image" name="course_img" id="course_img">
                  
              
                  <hr>

                  <button type="submit" class="registerbtn" id="coursesubmitbtn" 
                    name="coursesubmitbtn">Submit</button>
                </div>
                
                <div class="container signin">
                 
                </div>
                
              </form>
         <div class="close">+</div>
    </div>
  </div>
</div>

<!-- Delete operation -->
<?php
if(isset($_REQUEST['delete'])){
  $sql = "DELETE FROM course WHERE course_id = {$_REQUEST['id']}";
  if($conn->query($sql) == TRUE){
    echo '<meta http-equiv="refresh" content="0;"/>';
  }else {
    echo "Unable to Delete data";
  }
}
?>


</body>
<script src="popup.js"></script>


</html>