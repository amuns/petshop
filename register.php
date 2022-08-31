<?php
	session_start();
	require('dbconn.php');
	require 'utils.php';
	if(isset($_POST['signup']))
	{
		$name=$_POST['Name'];
		$epattern="/^([a-z0-9]+)([a-z0-9]+)*@([a-z0-9]+\.)+[ a-z]{2,6}$/";
		$email=$_POST['Email'];
		if(!preg_match($epattern, $email)){
            $_SESSION['error']="Invalid email format!";
            header('location: register.php');
			echo "test";
            exit;
        }
		$password=$_POST['Password'];
		$mobno=$_POST['PhoneNumber'];
		$pattern='/^9[0-9]{9}$/';
        if(!preg_match($pattern, $mobno)){
            $_SESSION['error']="Invalid phone number!";
            header('location: register.php');
            exit;
        }
		$upattern="/^u[0-9]{1,6}$/";
		$userId=$_POST['UserId'];
		if(!preg_match($upattern, $userId)){
            $_SESSION['error']="Invalid UserId format!";
            header('location: register.php');
            exit;
        }
		$type='User';

		$sql="insert into LMS.user (Name,Type,UserId,EmailId,MobNo,Password) values ('$name','$type','$userId','$email','$mobno','$password')";

		if ($conn->query($sql) === TRUE) {
			echo "<script type='text/javascript'>alert('Registration Successful')</script>";
		} 
		else {
			//echo "Error: " . $sql . "<br>" . $conn->error;
			echo "<script type='text/javascript'>alert('User Exists')</script>";
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
		<meta name="keywords" content="shop Member Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
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

	<h1>The pet shop</h1>

	<div class="container">

	
		<div class="login">
			<a href="index.php"><img src="images/home.webp" style="vertical-align: text-bottom;" height="20px" alt=""></a>
            <a href="index.php" style="padding-right: 30px;">Home</a>

            <a href="adminlogin.php"><img src="images/admin.jpg" height="20px" style="vertical-align: text-bottom;" alt=""></a>
            <a href="adminlogin.php" style="padding-right: 30px;">Admin Login</a>

            <a href="userlogin.php"><img src="images/user.png" height="20px" style="vertical-align: text-bottom;" alt=""></a>
            <a href="userlogin.php">Login</a>
			<br><br>
			<h2>Sign Up</h2>
			<?=flashMessages();?>
			<form action="" method="post">
				<input type="text" Name="Name" placeholder="Name" required><br>
				<input type="text" Name="Email" placeholder="Email" required><br>
				<input type="password" Name="Password" placeholder="Password" required><br>
				<input type="text" Name="PhoneNumber" placeholder="Phone Number" required><br>
				<input type="text" Name="UserId" placeholder="User ID" required=""><br>
				
				
				<br>
			
			
			<br>
			<div class="send-button">
			    <input type="submit" name="signup" value="Sign Up">
			    </form>
			</div>
			<p style="color: white">By creating an account, you agree to our <a class="underline" href="terms.html">Terms?</a></p>
			<div class="clear"></div>
		</div>

		<div class="clear"></div>

	</div>

	<div class="footer w3layouts agileits">
		<p> &copy; © 2021 Pet Shop System. All Rights Reserved . </a></p>
		
	</div>



</body>
<!-- //Body -->

</html>
