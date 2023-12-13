<?php

require_once '../../model/user.php';
require_once '../../controller/DBcontroller.php';

class AuthController{
    public $db;

    //login functin
    public function login(User $user){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = " select * from user where userName='$user->userName' and 
            userPassowrd='$user->userPassowrd' ";
            $result = $this->db->select($query);
            if($result == false){
                return false;
            }else{
                //echo "<pre>";
                //print_r($result);
                //echo "<pre>";
               
                session_start();
                $_SESSION["userId"]= $result[0]["userId"] ;
                $_SESSION["userName"]= $result[0]["userName"] ;
                $_SESSION["userEmail"]= $result[0]["userEmail"] ;
                $_SESSION["userPhone"]= $result[0]["userPhone"] ;
                $_SESSION["userPassword"] = $result[0]["userPassowrd"] ;
                $_SESSION["rate"]= $result[0]["rate"] ;
                $_SESSION["userPhoto"]= $result[0]["image"] ;
                if($result[0]["userRoleId"]==1){
                $_SESSION["userRole"]= "admin";
                }else if ($result[0]["userRoleId"]==2){
                    $_SESSION["userRole"]= "driver";
                }else {
                    $_SESSION["userRole"]= "user";
                }
                return true;


            }
        }else{
            echo 'error in open connection';
            return false;
        }
    }

        //login functin
    public function register(User $user){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            
            $query = " insert into user(`userId`, `userName`, `userEmail`, `userPhone`, `userPassowrd`, `userRoleId`, `image`, `rate`) values('','$user->userName','$user->userEmail',
            '$user->userEmail','$user->userPassowrd','$user->userRoleId','../../view/images/R.png',0)";
            $result = $this->db->insert($query);
            //create wallet
            $qu= "insert INTO `cash`(`cashId`, `userId`, `funds`) VALUES ('','$result ',0)" ;
            $this->db->insert($qu);
            if(!$result){
                return false;
            }else{
               
                session_start();
                $_SESSION["userId"]= $result ;
                $_SESSION["userName"]= $user->userName;
                $_SESSION["userEmail"]=  $user->userEmail;
                $_SESSION["userPhone"]=  $user->userPhone;
                $_SESSION["userPassword"]=  $user->userPassowrd;
                $_SESSION["rate"]=  0.0 ;
                $_SESSION["userPhoto"]= '../../view/images/R.png';
                if($user->userRoleId==1){
                    $_SESSION["userRole"]= "admin";
                }else if ($user->userRoleId==2){
                    $_SESSION["userRole"]= "driver";
                    // car info 
                    $q="insert into `car`(`userId`, `model`, `caeNumber`, `CaeKind`, `carImage`) values ('$result','Uber Model','123 | ABC','CAR','../images/defaultCar.png')";
                    $this->db->insert($q);
                    // car info 
                }else{
                    $_SESSION["userRole"]= "user";
                }
                return true;


            }
        }else{
            echo 'error in open connection';
            return false;
        }
    }

    //select all users functin
    public function selectAllUser(){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = " select * from user where 1 ";
            $result = $this->db->select($query);
            if($result == false){
                return false;
            }else{
                return $result;
            }
        }else{
            echo 'error in open connection';
            return false;
        }
    }
    //select all users functin
    public function deleteUser($userId){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = "delete from  user where userId = '$userId'";
            $result = $this->db->delete($query);
            if($result == false){
                return false;
            }else{
                return true;
            }
        }else{
            echo 'error in open connection';
            return false;
        }
    }
    //select all users  
    public function selecAllUser(){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = "select * from `user` where 1 ";
            $result = $this->db->select($query);
            if($result == false){
                return false;
            }else{
                return $result;
            }
        }else{
            echo 'error in open connection';
            return false;
        }
    }
    








}


















?>