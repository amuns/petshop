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
			<?php include('header.php') ?>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Product CRUD</h2>
				<!-- <p class="col-12 text-center">With GREAT Power comes GREAT Responsibility.</p> -->
			</header>
			
			<div class="tm-paging-links">
				<nav>
					<ul>
						<li class="tm-paging-item"><a href="products.php" class="tm-paging-link active">List All Products</a></li>
						<li class="tm-paging-item"><a href="addproduct.php" class="tm-paging-link">Add Product</a></li><br>
                        <?=flashMessages();?>
					</ul>
				</nav>
			</div>

            <div class="row tm-gallery">
				<!-- gallery page 1 -->
				<div id="tm-gallery-page-pizza" class="tm-gallery-page">
				    <!-- <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
						<figure>
							<img src="img/gallery/1.jpg" alt="Image" class="img-fluid tm-gallery-img" />
							<figcaption>
								<h4 class="tm-gallery-title">Maecenas eget justo</h4>
								<p class="tm-gallery-description">Nam in suscipit nisi, sit amet consectetur metus. Ut sit amet tellus accumsan</p>
								<p class="tm-gallery-price">$80.25</p>
							</figcaption>
						</figure>
					</article> -->
                    <table class="table table-bordered" border="1" id="table_data">
                        <tr>
                            <th>S No.</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>

                        <?php 
                            $stmt=$conn->query("SELECT * from products");
                            $i=1;
                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                            echo "<tr>";
                                echo "<td>".$i."</td>";$i++;
                                echo "<td>".validate($row['name'])."</td>";
                                $cid=$row['category_id'];
                                $stmt1=$conn->query("SELECT name from category WHERE category_id=$cid");
                                $cat=$stmt1->fetch(PDO::FETCH_ASSOC);
                                echo "<td>".validate($cat['name'])."</td>";
                                echo "<td>".validate($row['description'])."</td>";
                            ?>
                                <td><img src="./uploads/<?=$row['image']?>" width="120px"></td>
                            <?php
                                echo "<td>RS. ".validate($row['price'])."</td>";
                                echo "<td>".validate($row['quantity'])."</td>";
                            ?>
                                <td>
                                    
                                    <button class="button1" style="position: relative; left: 8px;" onclick="window.location.href='editproduct.php?pid=<?=$row['product_id']?>';"><b>Edit</b></button> &nbsp; 
                                    <!-- button ko lagi link create garna onclick="window.location.href='deletecompany.php?';" -->
                                    <form method="POST" action="deleteproduct.php?pid=<?=$row['product_id']?>" style="float: right; margin-left: 10px;">
                                        <button class="button2" style="position: relative; left: -8px" name="deleteproduct" ><b>Delete</b></button>
                                    </form>
                                </td>      
                                <?php
                            echo "</tr>";
                            }
                        ?>

                    </table>
                </div>

                
            </div>

			
			
		</main>

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