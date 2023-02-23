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
//

if(isset($_REQUEST['quizsubmitbtn'])){
  //checking for empty fields
if(($_REQUEST['quiz_title'] == "")||($_REQUEST['quiz_time'] == "")||($_REQUEST['course_id'] == "")||
($_REQUEST['course_name'] == "")){

  $msg ='<div class="warning"  >
  <h3 style="text-align: center;
  border: 1px solid red;
 color: red;
 background-color: #ff72724f">Fill All Fields</h3></div>';
}
else {
  $quiz_title = $_REQUEST['quiz_title'];
  $quiz_time = $_REQUEST['quiz_time'];
  $course_id = $_REQUEST['course_id'];
  $course_name = $_REQUEST['course_name'];
 
  

  $sql = "INSERT INTO add_quiz ( quiz_title, quiz_time, course_id, course_name) VALUES ('$quiz_title', '$quiz_time',
  '$course_id', '$course_name')"; 
  if($conn->query($sql) == TRUE)
  {
    $msg =' 
<script>
alert("Quiz Added Succesfully");
</script>';
  }
  else{
    $msg =' 
<script>
alert("Unable to add quiz");
</script>';
  }
}
}
?>
//
<?php

if(isset($_POST['question_submit'])){
    $question_number = $_POST['Question_number'];
    $question_text = $_POST['Question_text'];
    $correct_choice = $_POST['correct_choice'];
    $course_id = $_POST['course_id'];
    $quiz_id = $_POST['quiz_id'];

    //choice array
    $choice = array();
    $choice[1] = $_POST['Choice_1'];
    $choice[2] = $_POST['Choice_2'];
    $choice[3] = $_POST['Choice_3'];
    $choice[4] = $_POST['Choice_4'];
    

$query = "INSERT INTO quiz (Question_number,Question_text,course_id,quiz_id ) VALUES ( '$question_number','$question_text','$course_id' ,'$quiz_id' )";
// $query .= "question_number,question_text,course_id,quiz_id )";
// $query .= " VALUES (";
// $query .= " '$question_number','$question_text','$course_id' ,'$quiz_id'";
// $query .= ")";
 
$result = mysqli_query($conn,$query);

// validate first query
if($result){
    foreach($choice as $c_option =>$value){
        if($value != "") {
            if($correct_choice == $c_option) {
                $is_correct = 1;
            }else{
                $is_correct= 0;
            }
              //second query for choices table
              $query = "INSERT INTO choices (";
              $query .= "Question_number,is_correct,choice )";
              $query .= " VALUES (";
              $query .= " '{$question_number}','{$is_correct}','{$value}') ";
             //validate query
              $insert_row = mysqli_query($conn,$query);
              if($insert_row){
                continue;
              }else{
                die("2nd query for choices could not be executed");
              }

        }
    }
    $msg ='<div class="warning"  >
      <h3 style="text-align: center;
       border: 1px solid green;
      color: green;
      background-color: #b7e3b7; width:95%;">Question Added Succesfully</h3></div>';
}

}
              $query = "SELECT * FROM quiz ";
              $questions = mysqli_query($conn,$query);
              $total = mysqli_num_rows($questions);
              $next = $total+1;


//
?>


<!Doctype HTML>
<html>
<head>
	<title>ADMIN</title>
	<link rel="stylesheet" href="quiz.css" type="text/css"/>
	
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
</head>


<body>
	
	<div id="mySidenav" class="sidenav">
	<p class="logo"><span>E</span>du-tech</p>
	<a href="dashboard.php" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
	<a href="courses.php"class="icon-a"><i class="fa fa-book" style="font-size:24px"></i> &nbsp;&nbsp;Courses</a>
	<a href="lectures.php"class="icon-a"><i class="fa fa-youtube-play" style="font-size:24px"></i> &nbsp;&nbsp;Lessons</a>
	<a href="quiz.php"class="icon-a"
    style="
    border: 3px solid #eeee;
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    border-style: inset;
    "><i class="fa fa-mortar-board" style="font-size:24px"></i> &nbsp;&nbsp;Quiz</a>
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
      <input type="text" name="checkid2" id="checkid2" placeholder=" Enter course id ..." style="
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

      
      <?php if(isset($_REQUEST['checkid2'])){
      echo '<a  id="button" class="button">Add</a>';
      }
      ?>
    </form>
    <?php
    $sql = "SELECT course_id FROM course";
    $result = $conn->query($sql);
    while($row = $result -> fetch_assoc()){
      if(isset($_REQUEST['checkid2']) && $_REQUEST['checkid2'] == $row['course_id']){
        $sql = "SELECT * FROM course WHERE course_id = {$_REQUEST['checkid2']}";
        $result = $conn->query($sql);
        $row = $result -> fetch_assoc();
        if(($row['course_id']) == $_REQUEST['checkid2']){
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
      $sql = "SELECT * FROM add_quiz WHERE course_id = {$_REQUEST['checkid2']}";
      $result = $conn->query($sql);
      
       
    ?> 
	<?php
    echo '<table style="color: black;" class="content-table">
      <thead>
      
    
    <tr>
        <th>Quiz ID</th>
        <th>Quiz title</th>
        <th>Time</th>
        <th>Edit/Delete</th>
      </tr>
    </thead>
   
    <tbody>';
    
     while($row = $result->fetch_assoc()){ ?>
      <tr>
        <td><?php echo $row['quiz_id']; ?></td>
        <td><?php echo $row['quiz_title']; ?></td>
        <td><?php echo $row['quiz_time']; ?></td>
        <td>
        <button type="submit" class="btn" name="view" value="view">
              <i class='fa fa-pencil-square-o' style='font-size:25px'></i>
            </button>&nbsp;&nbsp;&nbsp;
            <form method="POST" style="display:inline;">
            <input type="hidden" name="id" value=<?php echo $row['quiz_id']; ?>>
            <button type="submit" class="btn" name="delete" value="delete">
              <i class="fa fa-trash-o" style="font-size:25px;"></i>
            </button>&nbsp;&nbsp;&nbsp;
          
            
            <!-- <button type="submit" class="btn" name="add" id="addbutton">
            <i class="fa fa-plus-square" style="font-size:24px"></i>
            </button> -->
            <form method="POST" style="display:inline;">
            &nbsp;<a  id="addbutton" class="addbutton" name="add" type="submit">Add Q/A</a>
            </form>
           <?php {
            $_SESSION['quiz_id'] = $row['quiz_id'];
               $_SESSION['course_id'] = $row['course_id'];
           } ?>

        
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
            <h1>Add New Quiz</h1>
            <p>Please fill in this form to add new lesson.</p>
            <hr>
        
            <label for="course id"><b>Course ID</b></label>
            <input type="text" placeholder="Course id" name="course_id" id="course id"
            value="<?php if(isset($_SESSION['course_id'])){echo $_SESSION['course_id'];} ?>" readonly >
        
            <label for="course name"><b>Course Name</b></label>
            <input type="text" placeholder="Course name" name="course_name" id="course name"
            value="<?php if(isset($_SESSION['course_name'])){echo $_SESSION['course_name'];} ?>" readonly  >
        
            <label for="lesson name"><b>Quiz title</b></label>
            <input type="text" placeholder="Enter lesson name" name="quiz_title" id="lesson_name" >
            
             <label for="lesson desc"><b>Quiz Time </b></label>
            <input type="time" placeholder="Enter Description" name="quiz_time" id="lesson desc" >
            
            
            <hr>
             <?php if(isset($msg)){ echo $msg;} ?>
            <button type="submit" class="registerbtn" id="quizsubmitbtn" 
              name="quizsubmitbtn">Submit</button>
          </div>
          
          <div class="container signin">
           
          </div>
          
        </form>
   <div class="close">+</div>
</div>
</div>





<!-- Delete operation -->
<?php
if(isset($_REQUEST['delete'])){
  $sql = "DELETE FROM add_quiz WHERE quiz_id = {$_REQUEST['id']}";
  if($conn->query($sql) == TRUE){
    echo '<meta http-equiv="refresh" content="0;"/>';
  }else {
    echo "Unable to Delete data";
  }
}
?>
<!--  -->


    <div class="bg-model2" id="bg-model2">
        <div class="model-content2">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="container2">
                  <h1>Add Quiz Questions</h1>
                  <p>Please fill in this form to add questions</p>
                  <?php if(isset($msg)){ echo $msg;} ?>
                  <hr>
                  <div class="flex">
                     <label for="course id"><b>Course ID :</b></label>
                    <input type="text" placeholder="Course id" name="course_id" id="course id" style="width:auto;"
                    value="<?php if(isset($_SESSION['course_id'])){echo $_SESSION['course_id'];} ?>" readonly>
                
                    <label for="quiz_id"><b>Quiz ID :</b></label>
                    <input type="text" placeholder="quiz_id" name="quiz_id" id="quiz_id" style="width:auto;"
                    value="<?php if(isset($_SESSION['quiz_id'])){echo $_SESSION['quiz_id'];} ?>" readonly> 
                     </div>
                  <label for="Question _number"><b>Question Number</b></label>
                  <input type="number" placeholder="Question _number" name="Question_number" id="Question_number" 
                  value="<?php if(isset($next)){echo $next;} ?>" readonly>
              
                  <label for="Question_text"><b>Question :</b></label>
                  <input type="text" placeholder="Question_text" name="Question_text" id="Question_text">
              
                  <label for="Choice_1"><b>Choice 1:</b></label>
                  <input type="text" placeholder="Choice_1" name="Choice_1" id="Choice_1" >
                  
                   <label for="Choice_2"><b>Choice 2:</b></label>
                  <input type="text" placeholder="Choice_2" name="Choice_2" id="Choice_2" >
                  
                  <label for="Choice_3"><b>Choice 3:</b></label>
                  <input type="text" placeholder="Choice_3" name="Choice_3" id="Choice_3" >
                  <label for="Choice_4"><b>Choice 4:</b></label>
                  <input type="text" placeholder="Choice_4" name="Choice_4" id="Choice_4" >
                  
                  <label for="correct choice"><b>Correct option number</b></label>
                  <input type="number" placeholder="Correct choice" name="correct_choice" id="correct choice">
                  
                  <hr>
                  <button type="submit" class="registerbtn" id="question_submit" 
                    name="question_submit">Submit</button>
                </div>
                
                
              </form>
         <div class="close2">+</div>
      </div>
      </div>
      
      </div>
      </div>
<!--  -->

</body>
<script src="popup.js"></script>


</html>