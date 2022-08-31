<?php
session_start();
require('dbconn.php');

$id=$_GET['id'];

$userId=$_SESSION['UserId'];

$sql="insert into LMS.return (UserId,BookId) values ('$userId','$id')";

if($conn->query($sql) === TRUE)
{
echo "<script type='text/javascript'>alert('Request Sent to Admin.')</script>";
header( "Refresh:0.01; url=current.php?uid=$userId", true, 303);
}
else
{
    echo "<script type='text/javascript'>alert('Request Already Sent.')</script>";
    header( "Refresh:0.01; url=current.php?uid=$userId", true, 303);

}




?>