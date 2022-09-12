<?php 
    session_start();
    require_once 'dbconn.php';
    include 'utils.php';
    //debug($_POST);
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $uname=trim($_POST['uname']);
        $upass=trim($_POST['pass']);
        if(isset($_POST, $uname, $upass)){
            $stmt=$conn->query("SELECT * from users WHERE uname='$uname' and password='$upass'");
            if($stmt->rowCount()==0){
                $_SESSION['error']="Invalid Credentials!";
                header('location: login.php');
                exit;
            }
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['userData']=$row;
            if($row['utype'] === "ADMIN"){
                header('location: admin/dashboard.php');
                exit;
            }
            elseif($row['utype'] === "USER"){
                header('location: user/index.php');
                exit;
            }
            else{
                header('location: login.php');
                exit;
            }
            //debug($row);
            
            $_SESSION['error']="Invalid credentials!";
            header('location: login.php');
            exit;
            
        }
        else{
            header('location: login.php');
            exit;
        }
    }
    else{
        header('location: login.php');
        exit;
    }
?>