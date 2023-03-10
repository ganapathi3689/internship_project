<?php
include '../dbconnection.php';
if(isset($_GET['course_id'])){
    $courseid = $_GET['course_id'];
    $query = "SELECT * FROM quiz WHERE course_id = '$courseid' ";
    $total_questions = mysqli_num_rows(mysqli_query($conn,$query));

    //
    // to get first question number of particular courseid;
// Prepare a SELECT query to retrieve the first row for a given courseid
$sql = "SELECT question_number FROM quiz WHERE course_id = '$courseid' ORDER BY question_number ASC LIMIT 1";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query returned any rows
if (mysqli_num_rows($result) > 0) {
    // Fetch the first row
    $row = mysqli_fetch_assoc($result);

    // Output the questionnum value of the first row
     $number = $row['question_number'];
} else {
    echo "No results found";
}

}

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
    <link rel="stylesheet" href="quizpage.css?v=4">
    <title>Quizpage</title>
</head>
<body>
    <div class="background">
    <header>
     <div class="container">
        <h2>Certificate Quiz</h2>
     </div>

    </header>
    <main>
    <div  class="container container2">
    <?php
            if(isset($courseid)){
   
                $query3 = "SELECT * FROM course WHERE course_id = '$courseid' ";
          
            $result1 = $conn->query($query3);
        if($result1->num_rows > 0)
        {
            while($row1 = $result1->fetch_assoc()){
                ?>
        <h2>Test your <?php echo $row1['course_name']; ?> knowledge</h2><br>
        <p>
            This is a multiple choice quiz to test your <?php echo $row1['course_name']; ?> knowledge
        </p>
        <?php
            }
        }
    }
        ?>
        <ul><br>
            <li><strong>Number of Questions :</strong><?php echo $total_questions; ?> </li><br>
            <li><strong>Type :</strong>Multiple Choice </li><br>
            <?php
            if(isset($courseid)){
   
                $query2 = "SELECT * FROM add_quiz WHERE course_id = '$courseid' ";
          
            $result = $conn->query($query2);
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc()){
                ?>
            <li><strong>Estimated Time :</strong><?php echo $row['quiz_time']; ?></li>
            <?php
            }
        }
    } ?>
        </ul>
<br><br>
        <a href="question.php?course_id=<?php echo $courseid ;?>&n=<?php echo $number ;?>&i=1" class="btn">Start Quiz</a>

    </div>

    </main>
    </div>
</body>
</html>