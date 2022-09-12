<?php 
    session_start();
    require '../dbconn.php';
    require '../utils.php';

    $pid=$_GET['pid'];
   
    if(isset($_POST, $_POST['deleteproduct'])){
        
        try{
            $stmt=$conn->query("DELETE from products WHERE product_id=$pid");
            $stmt->execute();

            if($stmt){
                $_SESSION['error']="Table updated!";
                header("location: products.php");
                exit;
            }
            
        }
        catch(Exception $e){
            $_SESSION['error']="Oops deletion error!";
            header("location: products.php");
            exit;
        }
    }
    else{
        $_SESSION['error']="Oops unidentified error!";
        header("location: products.php");
        exit;
    }
?>