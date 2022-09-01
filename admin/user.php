<?php 
    @session_start();
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
                <li class="headnav"><a href="user.php">Customers</a></li>
				<li class="headnav" style="float:right"><a class="active" href="logout.php">Logout</a></li>
			</ul> 
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Customer Detail</h2>
				<!-- <p class="col-12 text-center">With GREAT Power comes GREAT Responsibility.</p> -->
			</header>
			
			<div class="tm-paging-links">
				<nav>
					<ul>
						<li class="tm-paging-item"><a href="user.php" class="tm-paging-link active">List of user and product</a></li>
						<!-- <li class="tm-paging-item"><a href="addproduct.php" class="tm-paging-link">Add Product</a></li> -->
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
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Category</th>
                            <th>quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>

                        <?php 
                            $sql=("SELECT * FROM USERS WHERE utype='USER'");
							$stmt=$conn->query($sql);
                            $i=1;
                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                            echo "<tr>";
                                echo "<td>".$i."</td>";
                                echo "<td>".validate($row['uname'])."</td>";
                                echo "<td>".validate($row['email'])."</td>";
                                // echo "<td>".validate($row['category'])."</td>";
                                // echo "<td>RS. ".validate($row['price'])."</td>";
                                // echo "<td>".validate($row['quantity'])."</td>";
                                ?>
                                <td>
                                    
                                    <button class="button1" style="position: relative; left: 8px;" onclick="window.location.href='approveproduct.php?uid=<?=$_GET['uid']?>&pid=<?=$row['product_id']?>';"><b>Approve</b></button> &nbsp; 
                                    <!-- button ko lagi link create garna onclick="window.location.href='deletecompany.php?';" -->
                                    <form method="POST" action="denyproduct.php?uid=<?=$_GET['uid']?>&&pid=<?=$row['product_id']?>" style="float: right;">
                                        <button class="button2" style="position: relative; left: -8px" name="deleteproduct" ><b>Deny</b></button>
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