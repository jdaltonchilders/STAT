<!--
This code was created by using the instructors provided code and W3 Schools.
-->

<?PHP

//include "dbConnection.php";
//
//$mysqli = setDbConnection();

if (isset($_POST['username']) and isset($_POST['password'])) 
{
  $user_id = $_POST['username'];
  $pass = $_POST['password'];
} 
else 
{
  $user_id = null;
  $pass = null;
}

$username = "dcsp06";
$password = "ab1234";
$hostname = "localhost";

$conn = new mysqli($hostname, $username, $password, $username);

if ($conn->connect_errno) 
{
    echo "Failed to connect to database: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

echo 'Username is ' . $user_id . ' and password is ' . $pass . '<br>';

$query = "SELECT user_name, privilege FROM user_table WHERE user_password = '" . $pass . "' AND user_id = '" . $user_id . "'";

$result = $conn->query($query);

if($row = $result->fetch_assoc()) {

    session_start();

    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $row['user_name'];
    $_SESSION['privilege'] = $row['privilege'];

    
    header("Location: dashboard.php");
} 

else {
    header("Location: index.php");
}
?>