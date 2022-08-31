<?php
    require('dbconn.php');
    $bookid=$_GET['id1'];
    $userId=$_GET['aid'];
    $uId=$_GET['uid'];
    $sql2="update LMS.record set Date_of_Issue=curdate(),Due_Date=date_add(curdate(),interval 15 day),Renewals_left=1 
        where BookId='$bookid' and UserId='$uId'";
    if($conn->query($sql2) === TRUE)
    {$sql4="update LMS.book set Availability=Availability-1 where BookId='$bookid'";
    $result=$conn->query($sql4);
    $sql6="insert into LMS.message (UserId,Msg,Date,Time) 
           values ('$uId','Your request for issue of BookId: $bookid has been accepted',curdate(),curtime())";
    $result=$conn->query($sql6);
    echo "<script type='text/javascript'>alert('Success')</script>";
    header( "Refresh:1; url=issue_requests.php?aid=$userId", true, 303);
    }
    else
    {
        echo "<script type='text/javascript'>alert('Error')</script>";
        header( "Refresh:1; url=issue_requests.php?aid=$userId", true, 303);

    }
    



?>