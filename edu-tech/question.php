<?php
include '../dbconnection.php';
session_start();
//set question number;
$number = $_GET['n'];
$courseid=$_GET['course_id'];
$i=$_GET['i'];



//query for the questions 
$query = "SELECT * FROM quiz where question_number = $number";

// //get the question
 $result = mysqli_query($conn,$query);
 $question = mysqli_fetch_assoc($result);
 //get choices
 $query = "SELECT * FROM choices WHERE question_number = $number";
 $choices = mysqli_query($conn,$query);
//total questions
    $query = "SELECT * FROM quiz WHERE course_id = '$courseid' ";
    $total_questions = mysqli_num_rows(mysqli_query($conn,$query));



// Close the database connection
// mysqli_close($conn);


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
    <link rel="stylesheet" href="question.css?v=6">
    <title>Quiz</title>
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
           <br> <div class="current">Question <?php echo $i;?> of <?php echo $total_questions; ?></div><br>
            
            <p class="question"><?php echo $question['question_text']?></p><br>
            <form action="process.php" method="POST">
                <ul class="choices">
                    <?php while($row = mysqli_fetch_assoc($choices)) { ?>
                    <li><input type="radio" name="choice" value="<?php echo $row['choice_id']; ?>"><?php echo $row['choice'] ;?></li><br>
                    <?php }?>
                </ul>
                <input type="hidden" name="number" value="<?php echo $number; ?>">
                <input type="hidden" name="i" value="<?php echo $i; ?>">
                <input type="hidden" name="course_id" value="<?php echo $courseid; ?>">
                <input type="submit" name="submit" value="submit" class="btn">
            </form>
        </div>
    </main>
    </div>
</body>
</html>