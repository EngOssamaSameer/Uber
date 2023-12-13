<?php

require_once '../../model/user.php';
require_once '../../controller/DBcontroller.php';
require_once '../../model/notification.php';


class profileController{
    public $db;

    //update profile
    public function updateProfil($userId,$name , $phone , $email  ){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = "update `user` set `userName`='$name',`userEmail`='$email',`userPhone`='$phone' where `userId`='$userId' ";
            $result = $this->db->update($query);
            $date = date("y-m-d-h-i");
            $query2 = "insert into  `notifi`(`userId`, `description`, `date`) values ('$userId','You are updated your profile info','$date')";
            $this->addNotifi($query2);
            if($result == false){
                return false;
            }else{
                session_start();
                $_SESSION["userName"]= $name;
                $_SESSION["userEmail"]=  $email;
                $_SESSION["userPhone"]=  $phone;
                return true;
            }
        }else{
            echo 'error in open connection';
            return false;
        }
    }
    //update Car info
    public function updateCarInfo($userId,$model , $number , $kind ,$fair ){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = "update `car` set `model`='$model',`caeNumber`='$number',`CaeKind`='$kind',`fair`='$fair' where userId='$userId' ";
            $result = $this->db->update($query);
            $date = date("y-m-d-h-i");
            $query2 = "insert into  `notifi`(`userId`, `description`, `date`) values ('$userId','You are updated your car info','$date')";
            $this->addNotifi($query2);
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

    //update profile Photo
    public function updatePhoto($userId,$loc){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = "update `user` set image = '$loc' where `userId`='$userId' ";
            $result = $this->db->update($query);
            $date = date("y-m-d-h-i");
            $query2 = "insert into  `notifi`(`userId`, `description`, `date`) values ('$userId','You are uploaded a new photo','$date')";
            $this->addNotifi($query2);
            if($result == false){
                return false;
            }else{
                //session_start();
                $_SESSION["userPhoto"]= $loc;
                return true;
            }
        }else{
            echo 'error in open connection';
            return false;
        }
    }

    //update Care Photo
    public function updateCarPhoto($userId,$loc){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = "update `car` set carImage = '$loc' where `userId`='$userId' ";
            $result = $this->db->update($query);
            $date = date("y-m-d-h-i");
            $query2 = "insert into  `notifi`(`userId`, `description`, `date`) values ('$userId','You are uploaded a new photo for Car info','$date')";
            $this->addNotifi($query2);
            if($result == false){
                return false;
            }else{
                //session_start();
                return true;
            }
        }else{
            echo 'error in open connection';
            return false;
        }
    }
    

    //change password 
    public function changePassword($userId,$pass){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = "update `user` set `userPassowrd`='$pass' where `userId`='$userId' ";
            $result = $this->db->update($query);
            $date = date("y-m-d-h-i");
            $query2 = "insert into  `notifi`(`userId`, `description`, `date`) values ('$userId','You are changed password','$date')";
            $this->addNotifi($query2);
            if($result == false){
                return false;
            }else{
            }
        }else{
            echo 'error in open connection';
            return false;
        }
    }

    //selectAllNotifi 
    public function selectAllNotifi($userId){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = "select description , date from `notifi` where userId = '$userId' ";
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

    //Add NEW notifi insaide this claas
    public function addNotifi($query){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $result = $this->db->insert($query);
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
    


    //Delete notifi
    public function deleteNotifi($userId,$notifiDate){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = "delete from `notifi` where userId='$userId' and date='$notifiDate'";
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

    
    //select car 
    public function selecCar($userId){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = "select * from `car` where userId = '$userId' ";
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

    //Add NEW notifi outsaide this claas 
    public function addNotification(Notification $notification){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = " insert INTO `notifi`(`userId`, `description`, `date`) VALUES ('$notification->userId','$notification->description','$notification->date')";
            $this->db->insert($query);
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
        //select all car  
    public function selecAllCar(){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = "select * from `car` where 1 ";
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