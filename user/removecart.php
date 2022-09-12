<?php 
    session_start();
    require '../dbconn.php';
    require '../utils.php';

    $id=$_GET['id'];
    $pid=$_GET['pid'];
    $uid=$_SESSION['userData']['user_id'];
    if(isset($_POST, $_POST['removefromcart'])){
        
        try{
            $stmt=$conn->query("DELETE from cart WHERE id=$id AND product_id=$pid AND user_id=$uid");
            $stmt->execute();

            if($stmt){
                $_SESSION['error']="Table updated!";
                header("location: cart.php");
                exit;
            }
            
        }
        catch(Exception $e){
            $_SESSION['error']="Oops deletion error!";
            header("location: cart.php");
            exit;
        }
    }
    else{
        $_SESSION['error']="Oops unidentified error!";
        header("location: products.php");
        exit;
    }
?>