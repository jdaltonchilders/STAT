<?php

include('dbConnection.php');

$conn = setConnectedDb();

session_start(); // Starting Session

$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{

// Define $username and $password
$user_id=$_POST['username'];
$password=$_POST['password'];

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "");

// To protect MySQL injection for Security purpose
$user_id = stripslashes($user_id);
$password = stripslashes($password);
$user_id = mysql_real_escape_string($user_id);
$password = mysql_real_escape_string($password);

// Selecting Database
$db = mysql_select_db("company", $connection);

// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from  where password='$password' AND username='$username'", $connection);
$rows = mysql_num_rows($query);

if ($rows == 1) {
$_SESSION['login_user']=$user_id; // Initializing Session
header("location: dashboard.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}

mysql_close($connection); // Closing Connection
}
}
?>