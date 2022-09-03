<?php 
    session_start();
    include '../utils.php';
    require_once '../dbconn.php';
	date_default_timezone_set('Asia/Kathmandu');
    $pid=$_GET['pid'];

	if(isset($_POST, $_POST['name'], $_POST['description'], $_POST['price'], $_POST['quantity'], $_POST['category_id'], $_POST['image'])){
        $id=$_POST['pid'];
		$pname=validate($_POST['name']);
		$desc=validate($_POST['description']);
		$price=validate($_POST['price']);
		$qty=validate($_POST['quantity']);
		$catid=$_POST['category_id'];
		$newimage="";
        if(isset($_FILES) && !empty($_FILES['img']['name'])){
            $extArray=['jpg', 'jpeg', 'png'];
            $ext=pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
            $dir="uploads/";
            if(!in_array($ext, $extArray)){
                $_SESSION['error']="Invalid Image type!";
                header('location: products.php');
                exit;
            }
            $newimage="img_".time().rand(1,100).'.'. $ext;
            // $imagename=basename($_FILES['image']['name']);
            $copy=copy($_FILES['img']['tmp_name'], "$dir/$newimage");
            if(!$copy){
                $_SESSION['error']="Error in image transfer!";
                header('location: products.php');
                exit;
            }
        }
        else{
            $newimage=$_POST['image'];
        }
        // debug($_POST);debug($_FILES);exit;

		$stmt=$conn->prepare("UPDATE products SET name='$pname', description='$desc', price=$price, quantity=$qty, category_id=$catid, image='$newimage' WHERE product_id=$id");
		$stmt->execute();
		if($stmt){
			$_SESSION['success']="Product updated Successfully!";
			header('location: products.php');
			exit;
		}
		$_SESSION['error']="Error Occured!";
		header('location: products.php');
		exit;
		
		
	}
    
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
			<?php include 'header.php'; ?>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Update Product</h2>
				<!-- <p class="col-12 text-center">With GREAT Power comes GREAT Responsibility.</p> -->
			</header>
			
			<div class="tm-paging-links">
				<nav>
					<ul>
						<li class="tm-paging-item"><a href="products.php" class="tm-paging-link">List All Products</a></li>
						<li class="tm-paging-item"><a href="addproduct.php" class="tm-paging-link">Add Product</a></li><br>
						<?=flashMessages();?>
					</ul>
				</nav>
			</div>
            <?php 
                $stmt=$conn->query("SELECT * from products WHERE product_id=$pid");
                $product=$stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="row tm-gallery">
				<!-- gallery page 1 -->
				<div id="tm-gallery-page-pizza" class="tm-gallery-page">
				    <form action="editproduct.php" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="pid" value="<?=$product['product_id'];?>">
                        Product Name: <input type="text" name="name" value="<?=$product['name']?>" required><br><br>
                        Description: <input type="text" name="description" value="<?=$product['description']?>" required><br><br>
                        Price: <input type="number" name="price" value="<?=$product['price']?>" required><br><br>
                        Quantity: <input type="number" name="quantity" value="<?=$product['quantity']?>" required><br><br>
                        Category: <select name="category_id">
							<?php 
								$stmt=$conn->query("Select category_id, name from category");
								while($c=$stmt->fetch(PDO::FETCH_ASSOC)){
									?>
									  <option value="<?=$c['category_id']?>" <?=$c['category_id']==$product['category_id']?"selected":""?>><?=$c['name']?></option>
							<?php
								} 
							?>
						</select><br><br>
                        <input type="hidden" name="image" value="<?=$product['image']?>">
                        Image: <input type="file" name="img">
                        <img src="./uploads/<?=$product['image']?>" width="120px" alt=""><br><br>
                        <input type="submit" value="Update">
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