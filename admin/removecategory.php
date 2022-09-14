<?php 
    session_start();
    require '../dbconn.php';
    require '../utils.php';

    $cid=$_GET['cid'];
    
    // debug($_POST);exit;
    if(isset($_POST, $_POST['removecategory'])){
        
        try{
            $stmt=$conn->query("DELETE from category WHERE category_id=$cid");
            $stmt->execute();

            if($stmt){
                $_SESSION['error']="Table updated!";
                header("location: category.php");
                exit;
            }
            
        }
        catch(Exception $e){
            $_SESSION['error']="Oops deletion error!";
            // $_SESSION['error']=$e;
            header("location: category.php");
            exit;
        }
    }
    else{
        $_SESSION['error']="Oops unidentified error!";
        header("location: category.php");
        exit;
    }
?>