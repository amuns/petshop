<?php
    session_start();
    require 'utils.php';
    require_once 'dbconn.php';
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        try{
            if(isset($_POST, $_POST['email'], $_POST['pass'], $_POST['uname'])){
                $email=validate($_POST['email']);
                $pass=validate($_POST['pass']);
                $uname=validate($_POST['uname']);
                $stmt=$conn->prepare("INSERT INTO users(uname, email, password) VALUES(:a, :b, :c)");
                $stmt->execute(array(
                    ':a'=>$uname,
                    ':b'=>$email,
                    ':c'=>$pass
                ));
                $_SESSION['success']="You are registered now!";
                header('location: login.php');
                exit;
            }
        }
        catch(Exception $e){
            $_SESSION['error']="Invalid Credentials!";
            header('location: login.php');
            exit;
        }
    }
    else{
        header('location: login.php');
        exit;
    }
?>