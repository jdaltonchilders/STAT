
<?PHP

session_start();

unset($_SESSION['user_name']);
unset($_SESSION['user_id']);
unset($_SESSION['teacher_id']);
unset($_SESSION['teacher_name']);
unset($_SESSION['course_id']);
unset($_SESSION['course_name']);

// User Rights
unset($_SESSION['privilege']);

session_destroy();
header("Location: index.php");
exit;

?>