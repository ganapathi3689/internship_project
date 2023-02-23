
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

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addquiz.css">
    <title>ADMIN</title>
</head>
<body>
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
                    value="<?php if(isset($_SESSION['quiz_id'])){echo $_SESSION['quiz_id'];} ?>"> 
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
</body>
</html>