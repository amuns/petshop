<?php
require('dbconn.php');
session_start();

$bookid=$_GET['id1'];
$uId=$_GET['uid'];
$userId=$_GET['aid'];

$sql="delete from LMS.record where UserId='$uId' and BookId='$bookid'";

if($conn->query($sql) === TRUE)
{
	$sql1="insert into LMS.message (UserId,Msg,Date,Time) values ('$uId','Your request for issue of BookId: $bookid  has been rejected',curdate(),curtime())";
 $result=$conn->query($sql1);
echo "<script type='text/javascript'>alert('Success')</script>";
header( "Refresh:0.01; url=issue_requests.php?aid=$userId", true, 303);
}
else
{
	echo "<script type='text/javascript'>alert('Error')</script>";
    header( "Refresh:0.01; url=issue_requests.php?aid=$userId", true, 303);

}




?>