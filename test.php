<?php
// Replace with your database credentials
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "internship_db";
//create connection

$conn = new mysqli($db_host,$db_user,$db_password,$db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to count rows with courseid = 1

if(isset($_REQUEST['checkid2'])){
  $courseid=$_REQUEST['checkid2'];
}
$sql2 = "SELECT COUNT(*) as count FROM add_quiz WHERE course_id = $courseid ";

// Execute query
$result = $conn->query($sql2);

while($result->num_rows < 1) {
    
    echo "There are " . $row["count"] . " rows with courseid = 1";

    
  
  }


else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
