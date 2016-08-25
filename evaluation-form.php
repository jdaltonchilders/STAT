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

    $course_id = $_GET['course_id'];
    $course_id = str_replace('%20', ' ', $course_id);
    $_SESSION['course_id'] = $course_id;


    $username = "dcsp06";
    $password = "ab1234";
    $hostname = "localhost";

    $conn = new mysqli($hostname, $username, $password, $username);

    if ($conn->connect_errno) 
    {
        header('Location: 500.html');
    }

    $teacher_name_query = "SELECT user_table.user_name FROM course_table INNER JOIN user_table ON course_table.teacher_id=user_table.user_id WHERE course_id = '" . $_SESSION[course_id] . "'";
    
    $teacher_name_result = $conn->query($teacher_name_query);

    if($conn->query($teacher_name_query)) 
    {
        while($row = $teacher_name_result->fetch_assoc())
        {
            $_SESSION['teacher_name'] = $row['user_name'];
        }
    }

    $eval_id_query = "SELECT schedule_id FROM schedule_table WHERE course_id = '" . $_SESSION[course_id] . "' AND student_id = '" . $_SESSION[user_id] . "'";

    $eval_id_result = $conn->query($eval_id_query);

    if($conn->query($eval_id_query)) 
    {
        while($row = $eval_id_result->fetch_assoc())
        {
            $_SESSION['eval_id'] = $row['schedule_id'];
        }
    }

    $course_name_query = "SELECT course_name FROM course_table WHERE course_id = '" . $_SESSION[course_id] . "'";
    
    $course_name_result = $conn->query($course_name_query);

    if($conn->query($course_name_query)) 
    {
        while($row = $course_name_result->fetch_assoc())
        {
            $_SESSION['course_name'] = $row['course_name'];
        }
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
                    <li>
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
                            <?PHP echo $_SESSION[user_name]; ?>'s Evaluation of <?PHP echo $_SESSION[teacher_name]; ?> for (<?PHP echo $_SESSION[course_id]; ?>) <?PHP echo $_SESSION[course_name]; ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-comment"></i> Dashboard/Evaluation
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <form action="log-evaluation.php" method="post">

                        <!-- Notice -->
                        <p>Please respond to the following questions regarding your experience with the instructor in this course.</p>

                        <!-- Rating 1 -->

                        <div class="form-group">
                            <label>The instructor created high expectations for the class.</label>
                            <select class="form-control" name="rating_1" required>
                                <option value="">----------</option>
                                <option value="1">Strong Disagree</option>
                                <option value="2">Disgree</option>
                                <option value="3">Neutral</option>
                                <option value="4">Agree</option>
                                <option value="5">Strong Agree</option>
                            </select>
                        </div>

                        <!-- Rating 2 -->

                        <div class="form-group">
                            <label>The instructor conveyed the course content in an effective manner.</label>
                            <select class="form-control" name="rating_2" required>
                                <option value="">----------</option>
                                <option value="1">Strong Disagree</option>
                                <option value="2">Disgree</option>
                                <option value="3">Neutral</option>
                                <option value="4">Agree</option>
                                <option value="5">Strong Agree</option>
                            </select>
                        </div>
                        <!-- Rating 3 -->

                        <div class="form-group">
                            <label>The instructor made the class interesting.</label>
                            <select class="form-control" name="rating_3" required>
                                <option value="">----------</option>
                                <option value="1">Strong Disagree</option>
                                <option value="2">Disgree</option>
                                <option value="3">Neutral</option>
                                <option value="4">Agree</option>
                                <option value="5">Strong Agree</option>
                            </select>
                        </div>

                        <!-- Rating 4 -->

                        <div class="form-group">
                            <label>The instructor was enthusiastic about the subject matter.</label>
                            <select class="form-control" name="rating_4" required>
                                <option value="">----------</option>
                                <option value="1">Strong Disagree</option>
                                <option value="2">Disgree</option>
                                <option value="3">Neutral</option>
                                <option value="4">Agree</option>
                                <option value="5">Strong Agree</option>
                            </select>
                        </div>

                        <!-- Rating 5 -->

                        <div class="form-group">
                            <label>The instructor was accessible outside of class time to respond to my questions or concerns.</label>
                            <select class="form-control" name="rating_5" required>
                                <option value="">----------</option>
                                <option value="1">Strong Disagree</option>
                                <option value="2">Disgree</option>
                                <option value="3">Neutral</option>
                                <option value="4">Agree</option>
                                <option value="5">Strong Agree</option>
                            </select>
                        </div>

                        <!-- Rating 6 -->

                        <div class="form-group">
                            <label>I learned a great deal in this class.</label>
                            <select class="form-control" name="rating_6" required>
                                <option value="">----------</option>
                                <option value="1">Strong Disagree</option>
                                <option value="2">Disgree</option>
                                <option value="3">Neutral</option>
                                <option value="4">Agree</option>
                                <option value="5">Strong Agree</option>
                            </select>
                        </div>

                        <!-- Rating 7 -->

                        <div class="form-group">
                            <label>The presentation of course content (lectures, web materials, and/or discussions, etc.) helped me learn in this class.</label>
                            <select class="form-control" name="rating_7" required>
                                <option value="">----------</option>
                                <option value="1">Strong Disagree</option>
                                <option value="2">Disgree</option>
                                <option value="3">Neutral</option>
                                <option value="4">Agree</option>
                                <option value="5">Strong Agree</option>
                            </select>
                        </div>

                        <!-- Rating 8 -->

                        <div class="form-group">
                            <label>The test were fair.</label>
                            <select class="form-control" name="rating_8" required>
                                <option value="">----------</option>
                                <option value="1">Strong Disagree</option>
                                <option value="2">Disgree</option>
                                <option value="3">Neutral</option>
                                <option value="4">Agree</option>
                                <option value="5">Strong Agree</option>
                            </select>
                        </div>

                        <!-- Rating 9 -->

                        <div class="form-group">
                            <label>Test reflect material present in lecture and/or assigned reading.</label>
                            <select class="form-control" name="rating_9" required>
                                <option value="">----------</option>
                                <option value="1">Strong Disagree</option>
                                <option value="2">Disgree</option>
                                <option value="3">Neutral</option>
                                <option value="4">Agree</option>
                                <option value="5">Strong Agree</option>
                            </select>
                        </div>

                        <!-- Rating 10 -->

                        <div class="form-group">
                            <label>Tests and/or assignments were graded within a reasonable period of time.</label>
                            <select class="form-control" name="rating_10" required>
                                <option value="">----------</option>
                                <option value="1">Strong Disagree</option>
                                <option value="2">Disgree</option>
                                <option value="3">Neutral</option>
                                <option value="4">Agree</option>
                                <option value="5">Strong Agree</option>
                            </select>
                        </div>
                        
                        <!-- Comments Feedback -->

                        <div class="form-group">
                            <label>Pro of this instructor?</label>
                            <textarea name="positive_feedback" class="form-control" rows="4"></textarea>
                        </div>


                        <div class="form-group">
                            <label>Con of this instructor?</label>
                            <textarea name="negative_feedback" class="form-control" rows="4"></textarea>
                        </div>

                    <input type="submit"><input type="reset">

                </form>
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
