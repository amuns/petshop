<?php
    require('dbconn.php');
    require '../utils.php';
    session_start();
    if(!isset($_SESSION['type']) || $_SESSION['type'] != 'User'){
        $_SESSION['error']="Please Log In!";
        unset($_SESSION['type']);
        header('location: ../userlogin.php');
        exit;
    }
?>

<?php 
    if ($_SESSION['UserId']) {
        $uId=$_GET['uid'];
        $sql="SELECT Name from LMS.user WHERE UserId='$uId'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_row($result);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Book Lounge</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php">The Book Lounge </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/profile.png" class="nav-avatar" />Welcome <?=$row[0]?>!
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.php?uid=<?=$uId?>">Your Profile</a></li>
                                    <!--li><a href="#">Edit Profile</a></li>
                                    <li><a href="#">Account Settings</a></li-->
                                    <li class="divider"></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active"><a href="index.php?uid=<?=$uId?>"><i class="menu-icon icon-home"></i>Home
                                </a></li>
                                 <li><a href="message.php?uid=<?=$uId?>"><i class="menu-icon icon-inbox"></i>Messages</a>
                                </li>
                                <li><a href="book.php?uid=<?=$uId?>"><i class="menu-icon icon-book"></i>All Books </a></li>
                                <li><a href="history.php?uid=<?=$uId?>"><i class="menu-icon icon-tasks"></i>Previously Borrowed Books </a></li>
                                <li><a href="recommendations.php?uid=<?=$uId?>"><i class="menu-icon icon-list"></i>Recommend Books </a></li>
                                <li><a href="current.php?uid=<?=$uId?>"><i class="menu-icon icon-list"></i>Currently Issued Books </a></li>
                            </ul>
                            <ul class="widget widget-menu unstyled">
                                <li><a href="logout.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    
                    <div class="span9">

                        <div class="content">
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="findbook.php?uid=<?=$uId?>" class="btn-box big span4"><i class=" icon-search"></i><b>Find Book</b>
                                    </a>
                                </div>
                            </div>
                            <!--/.module-->
                        </div>
                        
                        <!--/.content-->
                    </div>
                
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
<div class="footer">
            <div class="container">
                <center><b class="copyright">&copy; 2022 The Book Lounge </b>All rights reserved.</center>
            </div>
        </div>
        
        <!--/.wrapper-->
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="scripts/common.js" type="text/javascript"></script>
      
    </body>

</html>

<?php }
else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>