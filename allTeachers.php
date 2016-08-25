<?PHP

    session_start();

    if (isset($_SESSION[user_id]))
    {
      header("location: dashboard.php");
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
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>S.T.A.T | TEACHERS</title>

    <!-- Bootstrap Core CSS -->
    <link href="assests/css/bootstrap.min.css" rel="stylesheet">
    <link href="assests/css/sticky-footer.css" rel="stylesheet">   

    <!-- Custom CSS -->
    <link href="assests/css/scrolling-nav.css" rel="stylesheet">
    <link href="assests/css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">S.T.A.T.</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php#faq">FAQ</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#loginModal">Login</button>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Section -->
    <section id="intro" class="intro-section">
        <div class="container">
            <div class="jumbotron">
                <div class="row">
                    <h1>Welcome to S.T.A.T.</h1>
                    <p>Student's Teaching, About Teachers</p>
                    <p><a class="btn btn-primary btn-lg" href="allTeachers.php" disabled="disabled"
                        role="button">See Teachers</a></p>
                    <p>Table of Teachers Below:</p>
                </div>
            </div>
        </div>

<?php

$username = "dcsp06";
$password = "ab1234";
$hostname = "localhost";

$conn = new mysqli($hostname, $username, $password, $username);

if ($conn->connect_errno) 
{
    echo "Failed to connect to database: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
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
        echo '<th>' . $teacher_name[$id_2] . '</th>';
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
	header("location: 500.html");;
}

?>


     <!-- Modal  -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="loginModalLabel">Login to S.T.A.T</h4>
          </div>
          <div class="modal-body">
            <form action="login.php" method="post">
              <div class="form-group">
                <label for="username">NetID</label>
                <input type="userid" class="form-control" id="username" name="username" placeholder="NetID (ex: ab123)">
              </div>
              <div class="form-group">
                <label for="userpassword">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Banner Password (ex: orion)">
              </div>
              <div>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" name="submit" value="submit" class="btn btn-primary">
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>

    <!-- jQuery -->
    <script src="assests/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assests/js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="assests/js/jquery.easing.min.js"></script>
    <script src="assests/js/scrolling-nav.js"></script>

</body>

</html>