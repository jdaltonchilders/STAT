<?php
    session_start();
  
    if (!isset($_SESSION[user_id]))
    {
        header("location: index.php");
    }

    if ($_SESSION[privilege] != 'student')
    {
        header("location: 403.html");
    }

?>

<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>

<body>

<?php

function sum($rating_1, $rating_2, $rating_3, $rating_4, $rating_5, $rating_6, $rating_7, $rating_8, $rating_9, $rating_10)
{
 	$overall = $rating_1 + $rating_2 + $rating_3 + $rating_4 + $rating_5 + $rating_6 + $rating_7 + $rating_8 + $rating_9 + $rating_10;
 	$overall = $overall / 10;
 	return $overall;
}

$username = "dcsp06";
$password = "ab1234";
$hostname = "localhost";

$conn = new mysqli($hostname, $username, $password, $username);

if ($conn->connect_errno) 
{
    echo "Failed to connect to database: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$evaluation_id = $_SESSION[eval_id];
$student_id = $_SESSION[user_id];
$course_id = $_SESSION[course_id];
$rating_1 = isset($_POST['rating_1']) ? $_POST['rating_1'] : '';
$rating_2 = isset($_POST['rating_2']) ? $_POST['rating_2'] : '';
$rating_3 = isset($_POST['rating_3']) ? $_POST['rating_3'] : '';
$rating_4 = isset($_POST['rating_4']) ? $_POST['rating_4'] : '';
$rating_5 = isset($_POST['rating_5']) ? $_POST['rating_5'] : '';
$rating_6 = isset($_POST['rating_6']) ? $_POST['rating_6'] : '';
$rating_7 = isset($_POST['rating_7']) ? $_POST['rating_7'] : '';
$rating_8 = isset($_POST['rating_8']) ? $_POST['rating_8'] : '';
$rating_9 = isset($_POST['rating_9']) ? $_POST['rating_9'] : '';
$rating_10 = isset($_POST['rating_10']) ? $_POST['rating_10'] : '';
$positive_feedback = isset($_POST['positive_feedback']) ? $_POST['positive_feedback'] : '';
$negative_feeback = isset($_POST['negative_feedback']) ? $_POST['negative_feedback'] : '';

$gen_rate_eval = sum($rating_1, $rating_2, $rating_3, $rating_4, $rating_5, $rating_6, $rating_7, $rating_8, $rating_9, $rating_10);

$query = "INSERT INTO evaluation_table (evaluation_id, student_id, course_id, rating_1, rating_2, rating_3, rating_4, rating_5, rating_6, rating_7, rating_8, rating_9, rating_10, positive_feedback, negative_feedback, gen_rate_eval) VALUES ('$evaluation_id','$student_id','$course_id','$rating_1','$rating_2','$rating_3','$rating_4','$rating_5','$rating_6','$rating_7','$rating_8','$rating_9','$rating_10', '$positive_feedback', '$negative_feedback', '$gen_rate_eval')";

if($conn->query($query)) 
{

	$update_eval = "UPDATE schedule_table SET eval_submit=1 WHERE course_id = '" . $_SESSION[course_id] . "' AND student_id = '" . $_SESSION[user_id] . "'";

	if($conn->query($update_eval))
	{
		header("location: dashboard.php");
	}
	else 
	{
		header("location: 500.html");
	}
} 
else 
{
	header("location: 500.html");
}



?>

</body>

</html>