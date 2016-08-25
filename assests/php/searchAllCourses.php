<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Search</title>
</head>

<body>

<?php

$username = "dcsp06";
$password = "ab1234";
$hostname = "localhost";

$conn = new mysqli($hostname, $username, $password, $username);

if ($conn->connect_errno) 
{
    echo "Failed to connect to database: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$query = "SELECT course_id , course_name FROM course_table";

$result = $conn->query($query);

$courses_id[] = Array();
$courses_names[] = Array();
$courses = Array();

if($conn->query($query)) 
{
    
    while($row = $result->fetch_assoc()){
        $courses_id[] = $row['course_id'];
        $courses_names[] = $row['course_name'];
        
    }
    
    $id = 0;
    foreach ($courses_id as $value) {
        $courses[$id] = $value . " " . $courses_names[$id];
        $id += 1;
        
    }

    
//    print_r($courses);
    
    foreach($courses as $value){
        echo "$value <br>";
    }
    

    ?>
	<a href='search.html'>Click here to return to search.</a>
	<?PHP
} 
else 
{
	echo "<p>Search Not Found: " . $conn->errno . " " . $conn->error . "</p>";
}

?>

</body>

</html>