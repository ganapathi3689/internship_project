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
///
if(isset($_REQUEST['lessonsubmitbtn'])){
  //checking for empty fields
if(($_REQUEST['lesson_name'] == "")||($_REQUEST['lesson_desc'] == "")||($_REQUEST['course_id'] == "")||
($_REQUEST['course_name'] == "")){

  $msg =' 
<script>
alert("Fill all the fields");
</script>';
}
else {
  $lesson_name = $_REQUEST['lesson_name'];
  $lesson_desc = $_REQUEST['lesson_desc'];
  $course_id = $_REQUEST['course_id'];
  $course_name = $_REQUEST['course_name'];
 
  //video upload
  $lesson_link = $_FILES['lesson_link']['name'];
  $lesson_link_temp =$_FILES['lesson_link']['tmp_name'];
  $link_folder = './image/lessonvideo/'.$lesson_link;
  move_uploaded_file($lesson_link_temp,$link_folder);

  $sql = "INSERT INTO lesson ( lesson_name, lesson_desc,lesson_link, course_id, course_name) VALUES ('$lesson_name', '$lesson_desc',
  '$link_folder','$course_id', '$course_name')"; 
  if($conn->query($sql) == TRUE)
  {
    $msg =' 
<script>
alert("Lessons Added Succesfully");
</script>';
  }
  else{
    $msg =' 
<script>
alert("Unable to lessons");
</script>';
  }
}
}
?>

<!Doctype HTML>
<html>
<head>
	<title>ADMIN</title>
	<link rel="stylesheet" href="lectures.css" type="text/css"/>
	
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
</head>


<body>
	
	<div id="mySidenav" class="sidenav">
	<p class="logo"><span>E</span>du-tech</p>
	<a href="dashboard.php" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
	<a href="courses.php"class="icon-a"><i class="fa fa-book" style="font-size:24px"></i> &nbsp;&nbsp;Courses</a>
	<a href="#"class="icon-a" style="
    
    border: 3px solid #eeee;
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    border-style: inset;
    "><i class="fa fa-youtube-play" style="font-size:24px"></i> &nbsp;&nbsp;Lessons</a>
	<a href="quiz.php"class="icon-a"><i class="fa fa-mortar-board" style="font-size:24px"></i> &nbsp;&nbsp;Quiz</a>
	<a href="#"class="icon-a"><i class="fa fa-credit-card" style="font-size:24px"></i> &nbsp;&nbsp;payment</a>
	<a href="#"class="icon-a"><i class="fa fa-key" style="font-size:24px"></i> &nbsp;&nbsp;Change password</a>
	<a href="logout.php"class="icon-a" name="logout" ><i class="fa fa-sign-out" style="font-size:24px"></i> &nbsp;&nbsp;Logout</a>

</div>

<div id="main" style=" overflow: scroll;
    display: block;
    height: 100vh;">
  <div class="main1" >
  <div class="search">
    <form action="">
      <!-- <label for="checkid" style="
    font-size: 30px;
    font-weight: 600;">Enter Course id :</label> -->
      <div class="searchbar">
      <input type="text" name="checkid" id="checkid" placeholder=" Enter course id ..." style="
    background-color: #ffffff;
    color: black;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    width: 25%;
    border-radius-left: 5px;
    border-bottom-left-radius: 30px;
    border-top-left-radius: 30px;
    box-shadow: 0 0 20px rgb(0 0 0 / 15%);
    ">
      <button type="submit" style="
    
    background-color:#272c4a;
    color: white;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    opacity: 0.9;
    border-top-right-radius: 30px;
    border-bottom-right-radius: 30px;
    ">Search</button>
      </div>
      <?php if(isset($_REQUEST['checkid'])){
      echo '<a  id="button" class="button">Add</a>';
      }
      ?>
    </form>
    <?php
    $sql = "SELECT course_id FROM course";
    $result = $conn->query($sql);
    while($row = $result -> fetch_assoc()){
      if(isset($_REQUEST['checkid']) && $_REQUEST['checkid'] == $row['course_id']){
        $sql = "SELECT * FROM course WHERE course_id = {$_REQUEST['checkid']}";
        $result = $conn->query($sql);
        $row = $result -> fetch_assoc();
        if(($row['course_id']) == $_REQUEST['checkid']){
          $_SESSION['course_id'] = $row['course_id'];
          $_SESSION['course_name'] = $row['course_name'];
          ?>


  </div>
  <h3 style="background-color: #272c4a;color: white;border-radius: 3px;padding: 6px; font-size: larger;
    font-weight: 500;border:none;">
        Course ID : <?php if(isset($row['course_id'])){ echo $row['course_id'];} ?> ,  Course Name : 
          <?php if(isset($row['course_name'])){ echo $row['course_name'];} ?>
      </h3>
      <?php
      $sql = "SELECT * FROM lesson WHERE course_id = {$_REQUEST['checkid']}";
      $result = $conn->query($sql);
      
       
    ?>
	<?php
    echo '<table style="color: black;" class="content-table">
      <thead>
      
    
    <tr>
        <th>Lesson ID</th>
        <th>Lesson Name</th>
        <th>Lesson Description</th>
        <th>Edit/Delete</th>
      </tr>
    </thead>
   
    <tbody>';
    
     while($row = $result->fetch_assoc()){ ?>
      <tr>
        <td><?php echo $row['lesson_id']; ?></td>
        <td><?php echo $row['lesson_name']; ?></td>
        <td><?php echo $row['lesson_desc']; ?></td>
        <td>
        <button type="submit" class="btn" name="view" value="view">
              <i class='fa fa-pencil-square-o' style='font-size:25px'></i>
            </button>&nbsp;&nbsp;
            <form method="POST" style="display:inline;">
            <input type="hidden" name="id" value=<?php echo $row['lesson_id']; ?>>
            <button type="submit" class="btn" name="delete" value="delete">
              <i class="fa fa-trash-o" style="font-size:25px;"></i>
            </button>
        </form>
      </td>
      </tr>
      <?php
     }

    }
  }
   } ?>
    </tbody>
  </table>
     
</div>
<!-- ?php    else{
         echo "0 results";
         }
         ? -->
<div class="bg-model">
  <div class="model-content">
      <form action="" method="post" enctype="multipart/form-data">
          <div class="container">
            <h1>Add New Lesson</h1>
            <p>Please fill in this form to add new lesson.</p>
            <hr>
        
            <label for="course id"><b>Course ID</b></label>
            <input type="text" placeholder="Course id" name="course_id" id="course id"
            value="<?php if(isset($_SESSION['course_id'])){echo $_SESSION['course_id'];} ?>" readonly >
        
            <label for="course name"><b>Course Name</b></label>
            <input type="text" placeholder="Course name" name="course_name" id="course name"
            value="<?php if(isset($_SESSION['course_name'])){echo $_SESSION['course_name'];} ?>" readonly  >
        
            <label for="lesson name"><b>Lesson Name</b></label>
            <input type="text" placeholder="Enter lesson name" name="lesson_name" id="lesson_name" >
            
             <label for="lesson desc"><b>Lesson Description</b></label>
            <input type="text" placeholder="Enter Description" name="lesson_desc" id="lesson desc" >
            
            <label for="lesson link"><b>Lesson Video Link</b></label>
            <input type="file" placeholder="Choose video" name="lesson_link" id="lesson link">
            
            <hr>
             <?php if(isset($msg)){ echo $msg;} ?>
            <button type="submit" class="registerbtn" id="lessonsubmitbtn" 
              name="lessonsubmitbtn">Submit</button>
          </div>
          
          <div class="container signin">
           
          </div>
          
        </form>
   <div class="close">+</div>
</div>
</div>
</div>
</div>


<!-- Delete operation -->
<?php
if(isset($_REQUEST['delete'])){
  $sql = "DELETE FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
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