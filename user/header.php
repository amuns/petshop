<?php
    @session_start();
?>
<div class="parallax-window" data-parallax="scroll" data-image-src="../img/banner.png">
</div>
<ul class="headnav">
    
    <li class="headnav"><a href="index.php">Home</a></li>
    <li class="headnav"><a href="products.php">Products</a></li>
    <li class="headnav"><a href="cart.php">Cart</a></li>
    <li class="headnav" style="float:right"><a class="active" href="logout.php">Logout</a></li>
    <li class="headnav" style="float:right"><a>Welcome, <?=$_SESSION['userData']['uname']?>!</a></li>
</ul>