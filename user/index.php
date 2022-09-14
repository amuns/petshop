<?php 
    session_start();
    require '../dbconn.php';
    require '../utils.php';
    // debug($_SESSION['userData']);exit;
    if(!isset($_SESSION['userData']) || $_SESSION['userData']['utype']!="USER"){
        $_SESSION['error']="Please Log In first!";
        header('location: ../login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>The Pet Shop</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" />    
	<link href="css/templatemo-style.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<!--

Simple House

https://templatemo.com/tm-539-simple-house

-->
<body> 

	<div class="container">
	<!-- Top box -->
		<!-- Logo & Site Name -->
		

			<?php
				include 'header.php';
			?> 
		<main>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Welcome to Pet Shop</h2>
				<p class="col-12 text-center">Our goal is to achieve customers' satisfaction and try be known for our services in the locality.</p>
			</header>
			
				

			
			
		</main>

		<?php include 'footer.php'; ?>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/parallax.min.js"></script>
	<script>
		$(document).ready(function(){
			// Handle click on paging links
			$('.tm-paging-link').click(function(e){
				e.preventDefault();
				
				var page = $(this).text().toLowerCase();
				$('.tm-gallery-page').addClass('hidden');
				$('#tm-gallery-page-' + page).removeClass('hidden');
				$('.tm-paging-link').removeClass('active');
				$(this).addClass("active");
			});
		});
	</script>
</body>
</html>