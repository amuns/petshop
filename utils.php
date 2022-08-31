<?php 
    function flashMessages(){
        if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
            echo "<center><span style='color: green'>".$_SESSION['success']."</span></center>";
            unset($_SESSION['success']);
        }

        if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
            echo "<center><span style='color: red'>".$_SESSION['error']."</span></center>";
            unset($_SESSION['error']);
        }
    }

    function debug($str){
        echo "<pre>";
        print_r($str);
        echo "</pre>";
    }
?>