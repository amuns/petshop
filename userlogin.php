<?php
session_start();
require 'utils.php';
require('dbconn.php');
	if(isset($_POST['signin']))
	{
			$u=$_POST['UserId'];
			$p=$_POST['Password'];

			$sql="select UserId, Password, Type from LMS.user where UserId='$u'";

			$result = $conn->query($sql);
			if(mysqli_num_rows($result)<=0){
				$_SESSION['error']="Invalid Credentials!";
				header('location: userlogin.php');
				exit;	
			}
			$row = $result->fetch_assoc();
			$x=$row['Password'];
			$y=$row['Type'];
			if(strcasecmp($x,$p)==0 && !empty($u) && !empty($p))
			{//echo "Login Successful";
				$_SESSION['UserId']=$u;
				$_SESSION['type']=$y;

				if($y=='User'){
					header("location:user/index.php?uid=".$row['UserId']);
					exit;
				}
				else 
				{
					header('location:login.php');
					echo "<script type='text/javascript'>alert('Failed to Login! Incorrect User ID or Password')</script>";
					exit;
				}
			}
			else{
				$_SESSION['error']="Invalid Credentials!";
				header('location: userlogin.php');
				exit;
			}		

	}
	

?>


<!DOCTYPE html>
<html>

<!-- Head -->
<head>

	<title>The Pet shop</title>

	<!-- Meta-Tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Library Member Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //Meta-Tags -->

	<!-- Style --> <link rel="stylesheet" href="css/style.css" type="text/css" media="all">

	<!-- Fonts -->
		<link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<!-- //Fonts -->

</head>
<!-- //Head -->

<!-- Body -->
<body>

	<h1>The Pet Shop</h1>
    
	<div class="container">

		<?=flashMessages();?>
		<div class="login">
			<a href="index.php"><img src="images/home.webp" style="vertical-align: text-bottom;" height="20px" alt=""></a>
            <a href="index.php" style="padding-right: 30px;">Home</a>
			
            <a href="adminlogin.php"><img src="images/admin.jpg" height="20px" style="vertical-align: text-bottom;" alt=""></a>
            <a href="adminlogin.php" style="padding-right: 30px;">Admin Login</a>
			
            <a href="register.php"><img src="images/register.jpg" height="20px" style="vertical-align: text-bottom;" alt=""></a>
            <a href="register.php">Register</a>
			<h2><center>Login</center></h2>
			<form action="" method="post" align="center">
				<input type="text" Name="UserId" placeholder="User ID" style="text-align: center;" required>
				<input type="password" Name="Password" placeholder="Password" style="text-align: center;" required>
			
			
			<div class="send-button">
				<!--<form>-->
					<input type="submit" name="signin" value="Sign In">
				</form>
			</div>
			
			<div class="clear"></div>

		
        </div>
		<div class="clear"></div>

	</div>

	<div class="footer w3layouts agileits">
		<p> &copy; 2021 Pet Shop System. All Rights Reserved .</a></p>
		
	</div>






</body>
<!-- //Body -->

</html>
