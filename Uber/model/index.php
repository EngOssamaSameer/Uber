<?php
session_start();
if(!isset($_SESSION["userRole"])){
  header("location: view/main/login.php");
}else{
    if($_SESSION["userRole"] == "user" ){
        header("location: view/user/home.php");
    
    }if($_SESSION["userRole"] == "driver" ){
        header("location: view/driver/home.php");
    
    }if($_SESSION["userRole"] == "admin" ){
        header("location: view/admin/home.php");
    
    }
}



?>