<?php 
    session_start();
    require '../dbconn.php';
    require '../utils.php';

    $uid=$_GET['uid'];
   
    if(isset($_POST, $_POST['removeuser'])){
        
        try{
            $stmt=$conn->query("DELETE from users WHERE user_id=$uid");
            $stmt->execute();

            if($stmt){
                $_SESSION['error']="Table updated!";
                header("location: user.php?uid=$uid");
                exit;
            }
            
        }
        catch(Exception $e){
            $_SESSION['error']="Oops deletion error!";
            header("location: user.php?uid=$uid");
            exit;
        }
    }
    else{
        $_SESSION['error']="Oops unidentified error!";
        header("location: user.php?uid=$uid");
        exit;
    }
?>