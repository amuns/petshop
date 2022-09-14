<?php 
    session_start();
    require 'dbconn.php';
    require 'utils.php';
    // debug($_SESSION['userData']);exit;
    // if(!isset($_SESSION['userData']) || $_SESSION['userData']['utype']!="USER"){
    //     $_SESSION['error']="Please Log In first!";
    //     header('location: ../login.php');
    //     exit;
    // }

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>The Pet shop</title>
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
		<div class="placeholder">
			<div class="parallax-window" data-parallax="scroll" data-image-src="img/banner.png">
				
			</div>
		</div>

		<main>
			<?php
				include 'header.php';
			?>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Our Products</h2>
				<?=flashMessages();?>

			</header>
			
			<div class="tm-paging-links">
				<nav>
					<ul>
						<li class="tm-paging-item"><a href="products.php" class="tm-paging-link">Food</a></li>
						<li class="tm-paging-item"><a href="accessories.php" class="tm-paging-link active">Accessories</a></li>
						<li class="tm-paging-item"><a href="firstaidkit.php" class="tm-paging-link">First Aid Kit</a></li>
						<li class="tm-paging-item"><a href="pets.php" class="tm-paging-link">Pets</a></li>
						
					</ul><br><br>
                    <ul>
						<form action="" method="POST">
							<textarea name="search_data" cols="30" rows="1" placeholder="Search by Product Name"></textarea>
							<input type="submit" style="vertical-align: top;" value="Search">
						</form>

					</ul>
				</nav>
			</div>		

			<!-- Gallery -->
			<div class="row tm-gallery">
				<!-- gallery page 1 -->
				<div id="tm-gallery-page-pizza" class="tm-gallery-page">
                    <?php 
                        $sql="";
                        if(isset($_POST['search_data'])){
                            $keyword=$_POST['search_data'];
                            $sql=("SELECT * FROM products WHERE name LIKE '%$keyword%' AND category_id=2");
                          }
                          else{
                            $sql=("SELECT * FROM products WHERE category_id=2");
                          } 
                        $stmt=$conn->query($sql);
                        if($stmt->rowCount()<=0){
                    ?>
                            <p class="tm-gallery-description">No Products Available!</p>
                    <?php
                        }
                        else{
                        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                            <figure>
                                <img src="../admin/uploads/<?=$row['image']?>" width="200px" alt="<?=$row['name']?>" class="img-fluid tm-gallery-img" />
                                <figcaption>
                                    <h4 class="tm-gallery-title"><?=$row['name']?></h4>
                                    <p class="tm-gallery-description"><?=$row['description'];?></p>
                                    <p class="tm-gallery-price">Rs. <?=$row['price']?></p>
                                    <button onclick="window.location.href='user/cart.php?pid=<?=$row['product_id']?>'">Add to Cart</button>
                                </figcaption>
                            </figure>
                        </article>
                    <?php 
                    }
                }
                    ?>
					
				</div> <!-- gallery page 1 -->
				
				
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