<?php
$dbservername = "127.0.0.1";
$dbusername = "amuns";
$dbpassword = "A@shri2017";
// Create connection
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword);
// Check connection
if (!$conn) {
    echo "Connected unsuccessfully";
    die("Connection failed: " . mysqli_connect_error());
}
?>
