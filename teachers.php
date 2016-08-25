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
    	echo "Failed to connect to database: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
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
                            Teachers <small>(<?PHP echo $_SESSION[privilege]; ?>)</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-suitcase"></i> Teachers
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

$query = "SELECT user_id, user_name FROM user_table WHERE privilege = 'teacher'";

$result = $conn->query($query);

$teacher_id[] = array();
$teacher_name[] = array();
$teachers = array();

if($conn->query($query)) 
{
    
    while($row = $result->fetch_assoc()){
        $teacher_id[] = $row['user_id'];
        $teacher_name[] = $row['user_name'];
    }

    $id = 0;
    foreach ($teacher_id as $value) {
        $teachers[$id] = $value . " " . $teacher_name[$id];
        $id += 1;
        
    }
	$id_2 = 1;
	echo '<div class="col-lg-12">';
    echo '<h2>List of All Teachers</h2>';
    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered table-hover table-striped">';
    echo '<thead>';
    echo '<tr>
            <th>NetID</th>
            <th>Full Name</th>
            <th>Rating</th>
        </tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach($teacher_id as $value){
		echo '<tr>';
		$overall_rating = overall_rating($teacher_id[$id_2]);
        echo '<th>' . $teacher_id[$id_2] . '</th>';
		echo '<th> <a href="http://pluto.cse.msstate.edu/~dcsp06/teacher.php?teacher_id=' . $teacher_id[$id_2] . '">' . $teacher_name[$id_2] . '</a> </th>';
		echo '<th>' . $overall_rating . '</th>';
		echo '</tr>';
		$id_2 += 1;
    }
	echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
else 
{
	header('Location: 500.html');
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
