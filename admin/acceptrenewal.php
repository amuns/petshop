<?php
session_start();
    require('dbconn.php');
    $bookid=$_GET['id1'];
    $userId=$_GET['aid'];
    $uId=$_GET['uid'];
    $sql2="update LMS.record set Due_Date=date_add(Due_Date,interval 15 day),Renewals_left=0 where BookId='$bookid' and UserId='$uId'";
    if($conn->query($sql2) === TRUE)
    {
        $sql4="delete from LMS.renew where BookId='$bookid' and UserId='$uId'";
        $result=$conn->query($sql4);
        $sql6="insert into LMS.message (UserId,Msg,Date,Time) 
                values ('$uId','Your request for renewal of BookId: $bookid has been accepted',curdate(),curtime())";
        $result=$conn->query($sql6);
        echo "<script type='text/javascript'>alert('Success')</script>";
        header( "Refresh:0.01; url=renew_requests.php?aid=$userId", true, 303);
    }
    else
    {
        echo "<script type='text/javascript'>alert('Error')</script>";
        header( "Refresh:0.01; url=renew_requests.php?aid=$userId", true, 303);

    }
    



?>