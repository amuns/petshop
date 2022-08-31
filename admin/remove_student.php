<?php 
    require 'dbconn.php';
    require '../utils.php';
    @session_start();
    if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Admin'){
        
        echo "<script type='text/javascript'>alert('Please Log in as Admin!')</script>";
        session_destroy();
        header('location: ../index.php');
        exit;
    }

    $userId=$_GET['id'];

    $sql="DELETE from LMS.user WHERE UserId='$userId'";

    $result=mysqli_query($conn, $sql);

    if($result){
        $_SESSION['error']="User with ID: $userId removed!";
        header('location: user.php');
        exit;
    }
    else{
        $_SESSION['error']=mysqli_error($con);
        header('location: user.php');
        exit;
    }

?>