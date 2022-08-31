<?php
    @session_start();
    require('dbconn.php');
    
    
    
    if ($_SESSION['UserId']) {
        $userId=$_GET['aid'];
        $sql="SELECT Name from LMS.user WHERE UserId='$userId'";
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
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php">The Pet Shop </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/profile.png" class="nav-avatar" />Welcome <?=$row[0]?>!
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.php?aid=<?=$userId?>">Your Profile</a></li>
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
                                <li class="active"><a href="index.php?aid=<?=$userId?>"><i class="menu-icon icon-home"></i>Home
                                </a></li>
                                <li><a href="message.php?aid=<?=$userId?>"><i class="menu-icon icon-inbox"></i>Messages</a>
                                </li>
                                <li><a href="user.php?aid=<?=$userId?>"><i class="menu-icon icon-user"></i>Manage User </a>
                                </li>
                                <li><a href="book.php?aid=<?=$userId?>"><i class="menu-icon icon-book"></i>All Books </a></li>
                                <li><a href="addbook.php?aid=<?=$userId?>"><i class="menu-icon icon-edit"></i>Add Books </a></li>
                                <li><a href="requests.php?aid=<?=$userId?>"><i class="menu-icon icon-tasks"></i>Issue/Return Requests </a></li>
                                <li><a href="recommendations.php?aid=<?=$userId?>"><i class="menu-icon icon-list"></i>Book Recommendations </a></li>
                                <li><a href="current.php?aid=<?=$userId?>"><i class="menu-icon icon-list"></i>Currently Issued Books </a></li>
                            </ul>
                            <ul class="widget widget-menu unstyled">
                                <li><a href="logout.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <div class="span9">
                        <center>
                            <a href="issue_requests.php?aid=<?=$userId?>" class="btn btn-info">Issue Requests</a>
                            <a href="renew_requests.php?aid=<?=$userId?>" class="btn btn-info">Renew Request</a>
                            <a href="return_requests.php?aid=<?=$userId?>" class="btn btn-info">Return Requests</a>
                        </center>
                        <h1><i>Issue Requests</i></h1>
                        <table class="table" id = "tables">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Book Id</th>
                                    <th>Book Name</th>
                                    <th>Availabilty</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql="select * from LMS.record,LMS.book where Date_of_Issue is NULL and record.BookId=book.BookId order by Time";
                                    $result=$conn->query($sql);
                                    while($row=$result->fetch_assoc())
                                    {
                                        $bookid=$row['BookId'];
                                        $uId=$row['UserId'];
                                        $name=$row['Title'];
                                        $avail=$row['Availability'];
                                    
                                        
                                ?>
                                <tr>
                                    <td><?php echo strtoupper($uId) ?></td>
                                    <td><?php echo $bookid ?></td>
                                    <td><b><?php echo $name ?></b></td>
                                    <td><?php echo $avail ?></td>
                                    <td><center>
                                    <?php
                                        if($avail > 0)
                                        {
                                            echo "<a href=\"accept.php?aid=".$userId."&id1=".$bookid."&uid=".$uId."\" class=\"btn btn-success\">Accept</a>";
                                        }
                                    ?>
                                        <a href="reject.php?aid=<?php echo $userId ?>&id1=<?php echo $bookid ?> &uid=<?=$uId?>" class="btn btn-danger">Reject</a>
                                    </center></td>
                                </tr>
                                <?php 
                                    } 
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!--/.span3-->
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <div class="footer">
            <div class="container">
                <center><b class="copyright">&copy; 2021 Pet Shop System. All Rights Reserved .</center>
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


<?php
    }
    else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
    }
?>