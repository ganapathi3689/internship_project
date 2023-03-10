<?php
require('dbconnection.php');
   

if(isset($_REQUEST['view'])){
    $sql = "SELECT * FROM course WHERE course_id = {$_REQUEST['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>
<?php
if(isset($_REQUEST['requpdate'])){
    //checking for empty fields
    if(($_REQUEST['course_id'] == "")||($_REQUEST['course_name'] == "")||($_REQUEST['course_desc'] == "")||($_REQUEST['course_author'] == "")||
($_REQUEST['course_duration'] == "")||($_REQUEST['course_price'] == "")||($_REQUEST['course_original_price'] == "")){

  $msg =' 
<script>
alert("Fill all the fields");
</script>';
}else
//assigning user values to variable
$uid = $_REQUEST['course_id'];
$uname = $_REQUEST['course_name'];
$ucourse_desc = $_REQUEST['course_desc'];
$ucourse_author = $_REQUEST['course_author'];
$ucourse_duration = $_REQUEST['course_duration'];
$ucourse_price = $_REQUEST['course_price'];
$ucourse_original_price = $_REQUEST['course_original_price'];
//
$ucourse_image = $_FILES['course_img']['name'];
  $ucourse_image_temp =$_FILES['course_img']['tmp_name'];
  $uimg_folder = './image/courseimg/'.$ucourse_image;
  move_uploaded_file($ucourse_image_temp,$uimg_folder);
// $uimg = './image/courseimg/'.$_FILES['course_img']['name'];

$sql = "UPDATE course SET course_id='$uid' ,course_name = '$uname' , course_desc = '$ucourse_desc' ,
course_author = '$ucourse_author', course_duration='$ucourse_duration' ,course_price='$ucourse_price', course_original_price='$ucourse_original_price', 
course_img='$uimg_folder'
WHERE course_id='$uid' ";
if($conn->query($sql) == TRUE){
echo  
'<script>
alert("UPDATED");
</script>';
}else
$msg =' 
<script>
alert(" UPDATION FAILED");
</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editcourse.css">
    <title>Dashboard</title>
</head>
<body>
<div class="model-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="container">
                  <h1>Update Course</h1>
                  <p>Please fill in this form to update course.</p>
                  <hr>
                  <label for="course name"><b>Course ID</b></label>
                  <input type="text" placeholder="Enter The  Course id" name="course_id" id="course id" 
                  value="<?php if(isset($row['course_id'])){ echo $row['course_id'];} ?>" readonly>
                  <label for="course name"><b>Course Name</b></label>
                  <input type="text" placeholder="Enter The  Course Name" name="course_name" id="course name" 
                  value="<?php if(isset($row['course_name'])){ echo $row['course_name'];} ?>">
              
                  <label for="course desp"><b>Course Description</b></label>
                  <input type="text" placeholder="Enter  Course Description" name="course_desc" id="course desc" 
                  value="<?php if(isset($row['course_desc'])){ echo $row['course_desc'];} ?>">
              
                  <label for="auth"><b>Author</b></label>
                  <input type="text" placeholder="Enter Author Name" name="course_author" id="auth" 
                  value="<?php if(isset($row['course_author'])){ echo $row['course_author'];} ?>">
                  
                   <label for="course dur"><b>Course Duration</b></label>
                  <input type="text" placeholder="Enter The New Course Duration" name="course_duration" id="course dur" 
                  value="<?php if(isset($row['course_duration'])){ echo $row['course_duration'];} ?>">

                  <label for="course price"><b>Course Price</b></label>
                  <input type="number" placeholder="Enter The New Course Price" name="course_price" id="course  price" 
                  value="<?php if(isset($row['course_price'])){ echo $row['course_price'];} ?>">
                  
                   <label for="course orginal price"><b>Course Orginal Price</b></label>
                  <input type="number" placeholder="Enter The New Course Orginal Price" name="course_original_price" id="course original price"
                  value="<?php if(isset($row['course_original_price'])){ echo $row['course_original_price'];} ?>" >
                  
                  <label for="course image"><b>Course Image</b></label>
                  <img src="<?php  if(isset($row['course_img'])){ echo $row['course_img'];}?> " alt="" 
                  style="width:50%; height:auto;">
                  <input type="file" placeholder="Choose The Coure Image" name="course_img" id="course_img">
                  
              
                  <hr>

                  <button type="submit" class="registerbtn" id="coursesubmitbtn" 
                    name="requpdate">Update</button>
                    <div class="close"><a href="courses.php">+</a></div>
                   
                </div>
                
                <div class="container signin">
                 
                </div>
                
              </form>

         
    </div>
  </div>
</body>
</html>