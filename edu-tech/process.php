<?php
include '../dbconnection.php';
?>
<?php
session_start();
?>
<?php
if(!isset($_SESSION['score'])){
    $_SESSION['score']=0;
}
if($_POST){
    $courseid = $_POST['course_id'];
    //total questions
    $query = "SELECT * FROM quiz WHERE course_id = '$courseid' ";
    $total_questions = mysqli_num_rows(mysqli_query($conn,$query));

      //capture question number
      $number = $_POST['number'];
      //get i
      $i = $_POST['i'];
      //selected choice
      $selected_choice = $_POST['choice'];
      
// Prepare a SQL query to select all the rows where the courseid matches the input value
$sql = "SELECT question_number FROM quiz WHERE course_id = '$courseid'";

// Execute the SQL query and get the result
$result = mysqli_query($conn, $sql);

// Initialize an array to store the question numbers
$questionnumbers = array();

// Check if there are any matching rows
if (mysqli_num_rows($result) > 0) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Extract the questionnumber value from the row and add it to the array
        $questionnumbers[] = $row['question_number'];
    }
    // echo "The following question numbers belong to the course $courseid: " . implode(', ', $questionnumbers);
} 

      //what will be the next number
      $next = $i+1;
      $nextq = $questionnumbers[$i];
      // for ($q=1; $q <=$number ; $q++) { 
      //   $nextq = $questionnumbers[$q];
      // }
      
      //determine the correct choice for current question
      $query = " SELECT * FROM choices WHERE question_number = $number AND is_correct = 1";
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_assoc($result);
      $correct_choice = $row['choice_id'];

      //increase the score if correct
      if($selected_choice == $correct_choice){
        $_SESSION['score']++;
      }
      //redirect to next question or final score
      if($i == $total_questions){
        header("LOCATION: final.php?course_id=$courseid");
        
      }else{
        header("LOCATION: question.php?n=$nextq&course_id=$courseid&i=$next");
      }


}
?>