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
                    <li>
                        <a href="evaluations.php"><i class="fa fa-fw fa-comment"></i> Evaluations</a>
                    </li>
                    <li class="active">
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
                            Contacts <small>(<?PHP echo $_SESSION[privilege]; ?>)</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-question"></i> Contacts
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="col-lg-12">
                    <h2>Contact Information for Deans and Useful Individuals</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>College</th>
                                        <th>Title</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Dr. Jason Keith</td>
                                        <td>College of Engineering</td>
                                        <td>Dean</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Dr. Kair Babski-Reeves</td>
                                        <td>College of Engineering</td>
                                        <td>Interim Associate Dean of Research and Graduate Studies</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Dr. James Warnock</td>
                                        <td>College of Engineering</td>
                                        <td>Associate Dean of Academic Affaris and Student Services</td>
                                        <td>N/A</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

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
