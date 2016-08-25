<?PHP

	session_start();

    if (!isset($_SESSION[user_id]))
    {
      header("location: index.php");
    }

	function overall_rating($teacher_id){

	$username = "dcsp06";
	$password = "ab1234";
	$hostname = "localhost";

	$conn = new mysqli($hostname, $username, $password, $username);

	if ($conn->connect_errno) 
	{
    	header('Location: 500.html');
	}
	$query = "SELECT evaluation_table.gen_rate_eval FROM evaluation_table INNER JOIN course_table ON evaluation_table.course_id=course_table.course_id WHERE course_table.teacher_id='" . $teacher_id . "'";
	
	$result = $conn->query($query);
	
	$gen_rate_eval[] = array();
	$id = 0;
	
	if($conn->query($query))
	{
		while($row = $result->fetch_assoc()){
			$gen_rate_eval[$id] = $row['gen_rate_eval'];
			$id += 1;
		}
	}
	$overall_rating = array_sum($gen_rate_eval);
	$overall_rating = $overall_rating / count($gen_rate_eval);
	$overall_rating = number_format($overall_rating,2);

	return $overall_rating;

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
                    <li class="active">
                        <a href="teachers.php"><i class="fa fa-fw fa-suitcase"></i> Teachers</a>
                    </li>
                    <?PHP
                        if($_SESSION[privilege] == 'student')
                        {
                        echo'
                        <li>
                        <a href="evaluations.php"><i class="fa fa-fw fa-comment"></i> Evaluations</a>
                        </li>
                        <li>
                        <a href="contacts.php"><i class="fa fa-fw fa-question"></i> Contacts</a>
                        </li>';  
                        }
                    ?>
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
                            Teacher's Evaluation Results <small>(<?PHP echo $_SESSION[privilege]; ?>)</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-suitcase"></i> Teacher Evaluation Results
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

<?php

$teacher_id = $_GET['teacher_id'];

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



$query = "SELECT course_table.course_id, course_table.teacher_id, evaluation_table.rating_1, evaluation_table.rating_2, evaluation_table.rating_3, evaluation_table.rating_4, evaluation_table.rating_5, evaluation_table.rating_6, evaluation_table.rating_7, evaluation_table.rating_8, evaluation_table.rating_9, evaluation_table.rating_10, evaluation_table.positive_feedback, evaluation_table.negative_feedback  FROM course_table INNER JOIN evaluation_table ON course_table.course_id = evaluation_table.course_id WHERE course_table.teacher_id='" . $teacher_id . "'";

$result = $conn->query($query);
$course_ids = array();
$nonredundent_course_id = array();
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
$overall_rating = overall_rating($teacher_id);


$id = 0;
	
if($conn->query($query))
{
	while($row = $result->fetch_assoc()){
		$course_ids[$id] = $row['course_id'];
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
	$nonredundent_course_id[0] = $course_ids[0];
	$id_2 = 0;
	foreach ($course_ids as $value){
		
		if ($value == $nonredundent_course_id[$id_2]){
		$id_2 += 1;
		}
		else{
		array_push($nonredundent_course_id, $value);
		}
	}
	
	$average_rating_1 = array_sum($rating_1);
	$average_rating_1 = $average_rating_1 / count($rating_1);
	$average_rating_1 = number_format($average_rating_1,2);
	$average_rating_2 = ((array_sum($rating_2)) / (count($rating_2)));
	$average_rating_2 = number_format($average_rating_2,2);
	$average_rating_3 = ((array_sum($rating_3)) / (count($rating_3)));
	$average_rating_3 = number_format($average_rating_3,2);	
	$average_rating_4 = ((array_sum($rating_4)) / (count($rating_4)));
	$average_rating_4 = number_format($average_rating_4,2);
	$average_rating_5 = ((array_sum($rating_5)) / (count($rating_5)));
	$average_rating_5 = number_format($average_rating_5,2);
	$average_rating_6 = ((array_sum($rating_6)) / (count($rating_6)));
	$average_rating_6 = number_format($average_rating_6,2);
	$average_rating_7 = ((array_sum($rating_7)) / (count($rating_7)));
	$average_rating_7 = number_format($average_rating_7,2);
	$average_rating_8 = ((array_sum($rating_8)) / (count($rating_8)));
	$average_rating_8 = number_format($average_rating_8,2);
	$average_rating_9 = ((array_sum($rating_9)) / (count($rating_9)));
	$average_rating_9 = number_format($average_rating_9,2);
	$average_rating_10 = ((array_sum($rating_10)) / (count($rating_10)));
	$average_rating_10 = number_format($average_rating_10,2);
	$average_ratings = array($average_rating_1, $average_rating_2, $average_rating_3, $average_rating_4, $average_rating_5, $average_rating_6, $average_rating_7, $average_rating_8, $average_rating_9, $average_rating_10);
	echo '<h1>' . $teacher_name . '</h1>';
	echo '<h2> Overall Rating: ' . $overall_rating . '</h2>';
	echo '<table class="table table-striped">';
    echo '<tr>';
	echo '<td><h2>Rating Criteria</h2></td>';
    echo '<td><h2>Rating Average</h2></td>';
    echo '<tr>';

    echo '<tr>';
    echo '<td> High expectations for the their courses</td>';
    echo '<td>' . $average_rating_1 . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td> Conveys the course content in an effective manner</td>';
    echo '<td>' . $average_rating_2 . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td> They make the courses interesting</td>';
    echo '<td>' . $average_rating_3 . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td> Enthusiasm about the subject matter</td>';
    echo '<td>' . $average_rating_4 . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td> Accessiblity outside of class</td>';
    echo '<td>' . $average_rating_5 . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td> Amount of information learn from the course</td>';
    echo '<td>' . $average_rating_6 . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td> Presentations are effective in explaining material</td>';
    echo '<td>' . $average_rating_7 . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td> Test are fair (comparative to subject matter)</td>';
    echo '<td>' . $average_rating_8 . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td> Test reflect material discussed during the course</td>';
    echo '<td>' . $average_rating_9 . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td> Test/Assignments are graded in a timely manner</td>';
    echo '<td>' . $average_rating_10 . '</td>';
    echo '</tr>';
    echo '</table>';
	echo '<div class="row">';
                    echo'<div class="col-lg-6">';
                       echo'<div class="table-responsive">';
                            echo'<table class="table table-bordered table-hover">';
                                echo'<thead>';
                                    echo'<tr>';
                                        echo'<th>Positive Feedback</th>';
                                    echo'</tr>';
                                echo'</thead>';
								foreach($positive_feedback as $value){
										if($value != 'None'){
                           echo'<tbody>';
                                    echo'<tr>';
                                    echo'<td>' . $value . '</td>';
                                    echo'</tr>';
                                echo'</tbody>';
								}
								}
                            echo'</table>';
                        echo'</div>';
                    echo'</div>';

			echo'<div class="col-lg-6">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Negative Feedback</th>
                                    </tr>
                                </thead>';
                                foreach($negative_feedback as $value){
										if($value != 'None'){
                           echo'<tbody>';
                                    echo'<tr>';
                                    echo'<td>' . $value . '</td>';
                                    echo'</tr>';
                                echo'</tbody>';
								}
								}
                            echo'</table>
                        </div>
                    </div>
';
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
