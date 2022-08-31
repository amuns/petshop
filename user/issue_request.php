<?php
session_start();
require('dbconn.php');

$id=$_GET['id'];

$userId=$_SESSION['UserId'];

$sql="insert into LMS.record (UserId,BookId,Time) values ('$userId','$id', curtime())";

if($conn->query($sql))
{
echo "<script type='text/javascript'>alert('Request Sent to Admin.')</script>";
header( "Refresh:0.01; url=book.php?uid=$userId", true, 303);
}
else
{
	echo "<script type='text/javascript'>alert('Request Already Sent.')</script>";
    header( "Refresh:0.01; url=book.php?uid=$userId", true, 303);

}




?>