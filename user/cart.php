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
    
    
    if(isset($_GET['pid'])){
        $pid=$_GET['pid'];
        $uid=$_SESSION['userData']['user_id'];
        $stmt=$conn->query("SELECT * from cart WHERE product_id=$pid AND user_id=$uid");
        if($stmt->rowCount()>=1){
            $_SESSION['error']="Product Exists in Cart!";
            header('location: products.php');
            exit;
        }
        
        $stmt=$conn->prepare("INSERT INTO cart(product_id, user_id) VALUES(:a, :b)");
        $stmt->execute(array(
            ':a'=>$_GET['pid'],
            ':b'=>$_SESSION['userData']['user_id']
        ));
    }
    
    
    

    
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
				<h2 class="col-12 text-center tm-section-title">Cart Details</h2>
                <center><?=flashMessages()?></center>
				<!-- <p class="col-12 text-center">With GREAT Power comes GREAT Responsibility.</p> -->
			</header>
			
			

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
                            <th>S. No.</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>

                        <?php 
							$stmt=$conn->query("SELECT * from cart");
                            $i=1;
                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                            echo "<tr>";
                                echo "<td>".$i."</td>";$i++;
                                $pid=$row['product_id'];
                                $stmt1=$conn->query("SELECT name, image from products WHERE product_id=$pid");
                                $product=$stmt1->fetch(PDO::FETCH_ASSOC);
                                echo "<td>".$product['name']."</td>";
                            ?>
                                <td><img src="../admin/uploads/<?=$product['image']?>" width="120px"></td>
                            
                                <td>
                                    
                                    <!-- <button class="button1" style="position: relative; left: 8px; margin-right: 10px;" onclick="window.location.href='approveproduct.php?uid=<?=$_GET['uid']?>&pid=<?=$row['product_id']?>';"><b>Approve</b></button> &nbsp;  -->
                                    <!-- button ko lagi link create garna onclick="window.location.href='deletecompany.php?';" -->
                                    <form method="POST" action="removecart.php?id=<?=$row['id']?>&&pid=<?=$row['product_id']?>" style="float: right;">
                                        <button class="button2" name="removefromcart" ><b>Remove</b></button>
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
