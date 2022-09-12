<?php 
    session_start();
    require '../dbconn.php';
    require '../utils.php';

    $cid=$_GET['cid'];
   
    if(isset($_POST, $_POST['removecategory'])){
        
        try{
            $stmt=$conn->query("DELETE from category WHERE category_id=$cid");
            $stmt->execute();

            if($stmt){
                $_SESSION['error']="Table updated!";
                header("location: category.php?uid=$uid");
                exit;
            }
            
        }
        catch(Exception $e){
            $_SESSION['error']="Oops deletion error!";
            header("location: category.php?uid=$uid");
            exit;
        }
    }
    else{
        $_SESSION['error']="Oops unidentified error!";
        header("location: category.php?uid=$uid");
        exit;
    }
?>