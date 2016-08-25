<?php 
session_start();
  
  if (!isset($_SESSION[user_id]))
   {
      header("location: index.php");
   }

function get_total_eval()
	{
	$username = "dcsp06";
	$password = "ab1234";
	$hostname = "localhost";

	$conn = new mysqli($hostname, $username, $password, $username);

	if ($conn->connect_errno) 
	{
    	echo "Failed to connect to database: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	$submitted_eval = array();
	$query = "SELECT student_id FROM evaluation_table WHERE student_id='" . $_SESSION['user_id'] . "'";

	$result = $conn->query($query);
	$eval_number = 0;

	if($conn->query($query)) 
	{
		while($row = $result->fetch_assoc()){
			$eval_number += 1;
		}
	}
	return $eval_number;
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
                    <li class="active">
                        <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
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
                            Dashboard <small>(<?PHP echo $_SESSION[privilege]; ?>)</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
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
    echo "Failed to connect to database: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$query = "SELECT schedule_table.course_id, course_table.course_name, course_table.teacher_id, schedule_table.eval_submit, schedule_table.term FROM schedule_table INNER JOIN course_table ON schedule_table.course_id=course_table.course_id WHERE schedule_table.student_id='" . $_SESSION['user_id'] . "'";

$result = $conn->query($query);

$course_id = array();
$course_name = array();
$teacher_id = array();
$eval_submit = array();
$term = array();
$id = 0;

if($conn->query($query)) 
{
    
    while($row = $result->fetch_assoc()){
        $course_id[$id] = $row['course_id'];
        $course_name[$id] = $row['course_name'];
		$teacher_id[$id] = $row['teacher_id'];
		$eval_submit[$id] = $row['eval_submit'];
		$term[$id] = $row['term'];
		$id += 1;
    }

	$id_2 = 1;
	$submitted_eval = 0;
	echo '<h1>Welcome to STAT ' . $_SESSION['user_name'] . '</h1>';

    if($_SESSION[privilege] == 'student'){
    	echo '<h2> Current Courses: </h2>';
    	echo '<table class="table table-striped table-responsive">';
        echo '<tr>';
    	echo '<td><h3>Course ID</h3></td>';
        echo '<td><h3>Course Name</h3></td>';
        echo '<td><h3>Teacher ID</h3></td>';
        echo '<td><h3>Evaluation Submited</h3></td>';
        echo '<td><h3>Term</h3></td>';
    	echo '<tr>';
    	$id_2=0;
        foreach($course_id as $value){
    		echo '<tr>';
           echo '<td>' . $value . '</td>';
    		echo '<td>' . $course_name[$id_2] . '</td>';
    		echo '<td> <a href="http://pluto.cse.msstate.edu/~dcsp06/teacher.php?teacher_id=' . $teacher_id[$id_2] . '">' . $teacher_id[$id_2] . '</a> </td>';
    		if ($eval_submit[$id_2] == 0){
    		echo '<td> Not Submitted Click <a href="http://pluto.cse.msstate.edu/~dcsp06/evaluation-form.php?course_id=' . $value . '">here</a> to start evaluation </td>';
    		}
    		else{
    		echo '<td> Submitted </td>';
    		$submitted_eval += 1;
    		}
    		echo '<td>' . $term[$id_2] . '</td>';
    		echo '</tr>';
    		$id_2 += 1;
    	}
    	$term_eval_submitted = $submitted_eval;
    	$completed_eval = get_total_eval();
    	echo '<tr>';
    	echo '<td><h3> Evaluations submitted this semester: </h3></td>';
    	echo '<td><h3> Evaluations submitted total: </h3></td>';
    	echo '<tr>';
        echo '<tr>';
        echo '<td>' . $term_eval_submitted .'</td>';
        echo '<td>' . $completed_eval . '</td>';
        echo '</tr>';
    }
}

$teacher_query = "SELECT course_id, course_name, teacher_id FROM course_table WHERE teacher_id='" . $_SESSION['user_id'] . "'";

$rresult = $conn->query($teacher_query);

$tcourse_id = array();
$tcourse_name = array();
$tteacher_id = array();


$id_3 = 0;

if($conn->query($teacher_query)) 
{
    
    while($trow = $rresult->fetch_assoc()){
        $tcourse_id[$id_3] = $trow['course_id'];
        $tcourse_name[$id_3] = $trow['course_name'];
        $tteacher_id[$id_3] = $trow['teacher_id'];
        $id_3 += 1;
    }

    $id_4 = 1;

    if($_SESSION[privilege] == 'teacher')
    {
        echo '<h2> Courses: </h2>';
        echo '<table class="table table-striped table-responsive">';
        echo '<tr>';
        echo '<td><h3>Course ID</h3></td>';
        echo '<td><h3>Course Name</h3></td>';
        echo '<td><h3>Teacher ID</h3></td>';
        echo '<tr>';
        $id_4=0;
        foreach($tcourse_id as $values)
        {
            echo '<tr>';
            echo '<td>' . $values . '</td>';
            echo '<td>' . $tcourse_name[$id_4] . '</td>';
            echo '<td> <a href="http://pluto.cse.msstate.edu/~dcsp06/teacher.php?teacher_id=' . $tteacher_id[$id_4] . '">' . $tteacher_id[$id_4] . '</a> </td>';
            echo '</tr>';
            $id_4 += 1;
        }
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
