<?php
    session_start();
  
    if (isset($_SESSION[user_id]))
    {
        header("location: dashboard.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>S.T.A.T | HOME PAGE</title>

    <!-- Bootstrap Core CSS -->
    <link href="assests/css/bootstrap.min.css" rel="stylesheet">
    <link href="assests/css/sticky-footer.css" rel="stylesheet">   

    <!-- Custom CSS -->
    <link href="assests/css/scrolling-nav.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

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
                <a class="navbar-brand page-scroll" href="#page-top">S.T.A.T.</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#faq">FAQ</a>
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
                    <p><a class="btn btn-primary btn-lg" href="allTeachers.php" role="button">See Teachers</a></p>
                </div>
            </div>
        </div>

    <!-- Services Section -->
    <section id="faq" class="faq-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Frequently Asked Questions</h1>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">What does this website do?</h3>
                      </div>
                      <div class="panel-body">
                        <p>This website provides a place for students to easily provide evaluations for their professors. Then it allows for a user to check general evaluations statuses of all teachers and classes.</p>
                      </div>
                    </div>
                    
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">What kind of information can I find on this website?</h3>
                      </div>
                      <div class="panel-body">
                        <p>Ratings for professors and classes based off of student evaluations provide general ideas of which classes and professors a new student may find enjoyable. Comments made by previous students also provide an additional source of information.</p>
                      </div>
                    </div>
                    
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">As a student, am I required to do an evaluation?</h3>
                      </div>
                      <div class="panel-body">
                        <p>Students are highly encouraged to provide an honest evaluation but are not required.</p>
                      </div>
                    </div>
                    
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">When can I fill out an evaluation form?</h3>
                      </div>
                      <div class="panel-body">
                        <p>Evaluation forms will be made available during and near the end of the semester.</p>
                      </div>
                    </div>
                    
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Will the teacher know who filled out each evaluation?</h3>
                      </div>
                      <div class="panel-body">
                        <p>No, evaluations are completely anonymous and only availabe to the student who previously filled out the form.</p>
                      </div>
                    </div>
                    
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Do I need to be a student to use this website?</h3>
                      </div>
                      <div class="panel-body">
                        <p>No, guest users are able to access general information on all teachers and classes allowing for new and incoming students to access the website.</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
