<?php 
    require 'dbconn.php';
    require '../utils.php';
    if(isset($_POST['submit']))
    {
        $userId = $_GET['aid'];
        $name=$_POST['Name'];
        $email=$_POST['EmailId'];
        $mobno=$_POST['MobNo'];
        $pswd=$_POST['Password'];

        $sql1="update LMS.user set Name='$name', EmailId='$email', MobNo='$mobno', Password='$pswd' where UserId='$userId'";



        if($conn->query($sql1) === TRUE){
            header( "location: index.php?aid=$userId");
            exit;
        }
        else
        {//echo $conn->error;
            $_SESSION['error']="Error!";
            header("location: edit_admin_details.php?aid=$userId");
            exit;
        }
    }
?>