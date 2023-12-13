<?php

require_once '../../model/user.php';
require_once '../../controller/DBcontroller.php';
require_once '../../controller/profileController.php';

class serviceController{
    public $db;
    public $pro ;

    //select all users functin
    public function selectAll(){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = " select * from rents where 1 ";
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
    public function selectAllUnve(){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = " select * from unavalaiblerent where 1 ";
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
     
    //gerRent functin
    public function gerRent(Rent $rent){


        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = "update rents set rentCase=2,rentUserName='$rent->rentUserName',rentUserEmail='$rent->rentUserEmail' ,userId='$rent->userId' where  rentId='$rent->rentId'";
            $result = $this->db->update($query);

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

    //ENDRent functin
    public function endRent($rentId){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = "update rents set rentCase=1,rentUserName='null',rentUserEmail='null',userId=0 where  rentId='$rentId'";
            $result = $this->db->update($query);
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
    //DELETERent functin
    public function deleteRent($rentId){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = "delete from rents where rentId ='$rentId'";
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

    //Add NEW Rent functin
    public function addRent($rentPrice,$rentKind){
        $this->db = new DBcontroller ;

        if($this->db->openConnection()){
            $query = "insert into `rents`(`rentId`, `rentPrice`, `rentKind`, `rentCase`, `rentUserName`, `rentUserEmail`) values ('','$rentPrice','$rentKind','1','null','null')";
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

    //select all users functin
    public function searchSelectRent(){

        $this->db = new DBcontroller ;
        if($this->db->openConnection()){
            $query = " select `rentId`, `rentPrice`, `rentKind`, `rentCase` from `rents` where 1 ";
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