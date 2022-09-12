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
                $emailpattern="/^([a-z0-9\+_\-]+)@([a-z0-9\-]+\.)+[a-z]{2,6}$/";
                if(!preg_match($emailpattern, $email)){
                    $_SESSION['error']="Invalid Email Format!";
                    header('location: login.php');
                    exit;
                }

                $unamepattern="/^[a-zA-Z]+$/";
                if(!preg_match($unamepattern, $uname)){
                    $_SESSION['error']="Invalid Username Format!";
                    header('location: login.php');
                    exit;
                }
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