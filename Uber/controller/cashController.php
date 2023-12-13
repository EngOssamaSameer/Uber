<?php

require_once '../../controller/DBcontroller.php';

class cashController{
    public $db;
// ----------- sslect funds ----------------------
public function selectFunds($userId){

    $this->db = new DBcontroller ;
    if($this->db->openConnection()){
        $query = "select * from cash where userId='$userId' ";
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
// ----------- add funds ----------------------
// to user walllet 
public function addFunds($userId , $founds){
    $this->db = new DBcontroller ;

    if($this->db->openConnection()){
        $query = "update cash set funds='$founds' where userId = '$userId' ";
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
//to oner wallet form rent 
public function addFundsToOther($userId , $founds,$onerFunds){
    $this->db = new DBcontroller ;

    if($this->db->openConnection()){
        $query = "update cash set funds='$founds' where userId = '$userId' ";
        $result = $this->db->update($query);
        //oner funds
        $query1 = "update cash set funds='$onerFunds' where cashId =3 ";
        $result2 = $this->db->update($query1);

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
//to oner wallet form rent 
public function addFundsToDriverAndOner($userId , $Dcash , $Ocash){
    $this->db = new DBcontroller ;

    if($this->db->openConnection()){
        $driverFonds = $Dcash - 5 ;
        $query = "update cash set funds='$driverFonds' where userId = '$userId' ";
        $result = $this->db->update($query);
        //oner funds
        $OnerFonds = $Ocash + 5;
        $query1 = "update cash set funds='$OnerFonds' where cashId =4 ";
        $result2 = $this->db->update($query1);

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
 // add fair to driver wallet
 public function addFundsToDriverAndOnerFormTrip($fair , $userId,$usercash,$driverId,$drivercash,$onercash){
    $this->db = new DBcontroller ;

    if($this->db->openConnection()){
        // user funds
        $beforeFair = $usercash - $fair;
        $query1 =  "update cash set funds='$beforeFair' where userId = '$userId' ";
        $this->db->update($query1);
        //driver funds
        $beforePresantge = $fair-3+$drivercash ;
        $query2 =  "update cash set funds='$beforePresantge' where userId = '$driverId' ";
        $this->db->update($query2);
        //oner funds
        $onercasht = $onercash + 3 ;
        $query3 =  "update cash set funds='$onercasht' where userId = '9' ";
        $this->db->update($query3);

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

    

}






?>