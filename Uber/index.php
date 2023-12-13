<?php
session_start();
if(!isset($_SESSION["userRole"])){
  header("location: project/view/main/login.php");
}else{
    if($_SESSION["userRole"] == "user" ){
        header("location: project/view/user/home.php");
    
    }if($_SESSION["userRole"] == "driver" ){
        header("location: project/view/driver/home.php");
    
    }if($_SESSION["userRole"] == "admin" ){
        header("location: project/view/admin/home.php");
    
    }
}



?>