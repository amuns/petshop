<?php 
    session_start();
    include '../utils.php';
    require_once '../dbconn.php';


    if(isset($_SESSION['userData']) && $_SESSION['userData']['utype']=="ADMIN"){
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Simple House Template</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" />    
	<link href="css/templatemo-style.css" rel="stylesheet" />
	<link href="css/main.css" rel="stylesheet" />
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
		

		<main>
			<ul class="headnav">
				<li class="headnav"><a href="dashboard.php">Home</a></li>
				<li class="headnav"><a href="products.php">Products</a></li>
				<li class="headnav" style="float:right"><a class="active" href="logout.php">Logout</a></li>
			</ul> 
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Product CRUD</h2>
				<!-- <p class="col-12 text-center">With GREAT Power comes GREAT Responsibility.</p> -->
			</header>
			
			<div class="tm-paging-links">
				<nav>
					<ul>
						<li class="tm-paging-item"><a href="products.php" class="tm-paging-link">List All Products</a></li>
						<li class="tm-paging-item"><a href="addproduct.php" class="tm-paging-link active">Add Product</a></li>
					</ul>
				</nav>
			</div>
            <?php 
                if(isset($_POST, $_POST['name'], $_POST['description'], $_POST['price'], $_POST['quantity'], $_POST['image'])){
                    
                }
            ?>
            <div class="row tm-gallery">
				<!-- gallery page 1 -->
				<div id="tm-gallery-page-pizza" class="tm-gallery-page">
				    <form action="addproduct.php" enctype="multipart/form-data" method="POST">
                        Product Name: <input type="text" name="name" required><br><br>
                        Description: <input type="text" name="description" required><br><br>
                        Price: <input type="number" name="price" required><br><br>
                        Quantity: <input type="number" name="quantity" required><br><br>
                        Image: <input type="file" name="image" required><br><br>
                        <input type="submit" value="Add Product">
                    </form>
                    
                </div>

                
            </div>

			
			
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
<?php
    }
    else{
        $_SESSION['error']="Access Not Granted!";
        header('location: ../login.php');
        exit;
    }
?>