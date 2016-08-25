<?php 
session_start();
  
  if (!isset($_SESSION[user_id]))
   {
      header("location: index.php");
   }
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>S.T.A.T | <?PHP echo $_SESSION[user_name]; ?>'s Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="assests/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assests/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="assests/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assests/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php"><?PHP echo $_SESSION[user_name]; ?>'s Dashboard </a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?PHP echo $_SESSION[user_name]; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="teachers.php"><i class="fa fa-fw fa-suitcase"></i> Teachers</a>
                    </li>
                    <li class="active">
                        <a href="evaluations.php"><i class="fa fa-fw fa-comment"></i> Evaluations</a>
                    </li>
                    <li>
                        <a href="contacts.php"><i class="fa fa-fw fa-question"></i> Contacts</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Evaluations <small>(<?PHP echo $_SESSION[privilege]; ?>)</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-comment"></i> Evaluations
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

<?php


$username = "dcsp06";
$password = "ab1234";
$hostname = "localhost";

$conn = new mysqli($hostname, $username, $password, $username);

if ($conn->connect_errno) 
{
    header('Location: 500.html');
}

$teacher_name_query = "SELECT user_name FROM user_table WHERE user_id='" . $teacher_id . "'";

$name_result = $conn->query($teacher_name_query);

if($conn->query($teacher_name_query))
{
    while($row = $name_result->fetch_assoc()){
        $teacher_name = $row['user_name'];
    }
}


$query = "SELECT course_table.course_name, course_table.course_id, course_table.teacher_id, evaluation_table.rating_1, evaluation_table.rating_2, evaluation_table.rating_3, evaluation_table.rating_4, evaluation_table.rating_5, evaluation_table.rating_6, evaluation_table.rating_7, evaluation_table.rating_8, evaluation_table.rating_9, evaluation_table.rating_10, evaluation_table.positive_feedback, evaluation_table.negative_feedback  FROM course_table INNER JOIN evaluation_table ON course_table.course_id = evaluation_table.course_id WHERE evaluation_table.student_id='" . $_SESSION['user_id'] . "'";

$result = $conn->query($query);

$course_name = array();
$course_ids = array();
$teacher_id = array();
$rating_1 = array();
$rating_2 = array();
$rating_3 = array();
$rating_4 = array();
$rating_5 = array();
$rating_6 = array();
$rating_7 = array();
$rating_8 = array();
$rating_9 = array();
$rating_10 = array();
$positive_feedback = array();
$negative_feedback = array();



$id = 0;
	
if($conn->query($query))
{
	while($row = $result->fetch_assoc()){
		$course_name[$id] = $row['course_name'];
		$course_ids[$id] = $row['course_id'];
		$teacher_id[$id] = $row['teacher_id'];
		$rating_1[$id] = $row['rating_1'];
		$rating_2[$id] = $row['rating_2'];
		$rating_3[$id] = $row['rating_3'];
		$rating_4[$id] = $row['rating_4'];
		$rating_5[$id] = $row['rating_5'];
		$rating_6[$id] = $row['rating_6'];
		$rating_7[$id] = $row['rating_7'];
		$rating_8[$id] = $row['rating_8'];
		$rating_9[$id] = $row['rating_9'];
		$rating_10[$id] = $row['rating_10'];
		$positive_feedback[$id] = $row['positive_feedback'];
		$negative_feedback[$id] = $row['negative_feedback'];
		$id += 1;
	}

	

	echo '<h1>' . $_SESSION['user_name'] . '</h1>';
	echo '<h2> Past Evaluations: </h2>';
	echo '<table class="table table-striped">';
    echo '<tr>';
	echo '<td><h4>Course Name</h4></td>';
    echo '<td><h4>Course ID</h4></td>';
    echo '<td><h4>Teacher ID</h4></td>';
    echo '<td><h4>Rating 1</h4></td>';
    echo '<td><h4>Rating 2</h4></td>';
    echo '<td><h4>Rating 3</h4></td>';
    echo '<td><h4>Rating 4</h4></td>';
    echo '<td><h4>Rating 5</h4></td>';
    echo '<td><h4>Rating 6</h4></td>';
    echo '<td><h4>Rating 7</h4></td>';
    echo '<td><h4>Rating 8</h4></td>';
    echo '<td><h4>Rating 9</h4></td>';
    echo '<td><h4>Rating 10</h4></td>';
    echo '<td><h4>Positive Feedback</h4></td>';
    echo '<td><h4>Negative Feedback</h4></td>';
    echo '<tr>';
	$id_2=0;
    foreach($course_name as $value){
		echo '<tr>';
        echo '<td>' . $value . '</td>';
		echo '<td>' . $course_ids[$id_2] . '</td>';
		echo '<td>' . $teacher_id[$id_2] . '</td>';
		echo '<td>' . $rating_1[$id_2] . '</td>';
		echo '<td>' . $rating_2[$id_2] . '</td>';
		echo '<td>' . $rating_3[$id_2] . '</td>';
		echo '<td>' . $rating_4[$id_2] . '</td>';
		echo '<td>' . $rating_5[$id_2] . '</td>';
		echo '<td>' . $rating_6[$id_2] . '</td>';
		echo '<td>' . $rating_7[$id_2] . '</td>';
		echo '<td>' . $rating_8[$id_2] . '</td>';
		echo '<td>' . $rating_9[$id_2] . '</td>';
		echo '<td>' . $rating_10[$id_2] . '</td>';
		echo '<td>' . $positive_feedback[$id_2] . '</td>';
		echo '<td>' . $negative_feedback[$id_2] . '</td>';
		echo '</tr>';
		$id_2 += 1;
    }

	
}

?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="assests/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assests/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="assests/js/plugins/morris/raphael.min.js"></script>
    <script src="assests/js/plugins/morris/morris.min.js"></script>
    <script src="assests/js/plugins/morris/morris-data.js"></script>

</body>

</html>
