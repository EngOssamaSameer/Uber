<?php

require_once '../../controller/DBcontroller.php';

class eatController{
    public $db;
// ----------- sslect market ----------------------
public function selectMarket(){

    $this->db = new DBcontroller ;
    if($this->db->openConnection()){
        $query = "select * from market where 1 ";
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

// ----------- sslect market Menu ----------------------
public function selectMarketMenu(){

    $this->db = new DBcontroller ;
    if($this->db->openConnection()){
        $query = "select * from menu where 1 ";
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

// ----------- add new  market ----------------------
public function addNewMarket($name){
    $this->db = new DBcontroller ;

    if($this->db->openConnection()){
        $query = "insert into `market`(`marketId`, `marketName`) values ('','$name')";
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

// ----------- add new  item into menu ----------------------
public function addNewItem($marketId , $itemName , $itemPrice){
    $this->db = new DBcontroller ;

    if($this->db->openConnection()){
        $query = "insert into  `menu`(`marketId`, `item`, `price`) VALUES ('$marketId','$itemName','$itemPrice')";
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
/**    delete item from menu */
public function deleteItem($menuId){

    $this->db = new DBcontroller ;
    if($this->db->openConnection()){
        $query = "delete from `menu` where menuId = '$menuId' ";
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
// ----------- sslect market Menu ----------------------
public function selectRequestOrder(){

    $this->db = new DBcontroller ;
    if($this->db->openConnection()){
        $query = "select * from requestorder where 1 ";
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
/**    end Request order */
public function endRequestorder($orderId){

    $this->db = new DBcontroller ;
    if($this->db->openConnection()){
        $query = "delete from `requestorder` where orderId = '$orderId' ";
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
// ----------- update order to get order  ----------------------
public function getRequestorder($driverId,$orderId,$userId,$drivername){

    $this->db = new DBcontroller ;
    if($this->db->openConnection()){
        $query = "update `requestorder` set `driverId`='$driverId' , `case`=2 WHERE orderId = '$orderId' ";
        $result = $this->db->update($query);
        //notifi
        $date = date('h-i-s');
        $description = $drivername . '   Accept your request Order please check current trip';
        $query2 = " insert INTO `notifi`(`userId`, `description`, `date`) VALUES ('$userId',' $description ','$date')";
        $this->db->insert($query2);

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
// ----------- add new  equest Order ----------------------
public function addRequestOrder(orderdetails $ord){
    $this->db = new DBcontroller ;

    if($this->db->openConnection()){
        $query = "   insert INTO `requestorder`(`orderId`, `userId`, `userName`, `userEmail`
        , `address`, `phone`, `market`, `item`, `case`, `driverId`, `cash`) VALUES 
        ('','$ord->userId','$ord->name','$ord->email','$ord->address'
        ,'$ord->phone','$ord->market',' $ord->items',1,0,'$ord->cash')";
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
// ----------- add new  equest Trip ----------------------
public function addRequestTrip(tripdetails $trip){
    $this->db = new DBcontroller ;

    if($this->db->openConnection()){
        $query = "insert INTO `requesttrip`(`requestTrip`, `passengerId`, `driverId`, `pickup`, 
        `drop`, `name`, `phone`, `payment`, `cash`,`cas`,`eDate`,`sDate`) VALUES ('','$trip->userId','$trip->driverId',
        '$trip->pickup','$trip->drop','$trip->name','$trip->phone','$trip->payment','$trip->cash',0,'null','null')";
        $result = $this->db->insert($query);
        //notifi
        $date = date('h-i-s');
        $description = $trip->name . '   send requset trip please check request trips';
        $query2 = " insert INTO `notifi`(`userId`, `description`, `date`) VALUES ('$trip->driverId',' $description ','$date')";
        $this->db->insert($query2);

        // update car case to unavalaible
        $query2 = "update `car` SET `cas`=1 WHERE `userId`='$trip->driverId'";
        $this->db->update($query2);
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
// ----------- Select  equest Trip ----------------------
// For Driver
public function selectrequestTripForDriver($driverId){

    $this->db = new DBcontroller ;
    if($this->db->openConnection()){
        $query = "select * FROM `requesttrip` WHERE driverId='$driverId' ";
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
//for User
public function selectrequestTripForUser($passengerId){

    $this->db = new DBcontroller ;
    if($this->db->openConnection()){
        $query = "select * FROM `requesttrip` WHERE passengerId='$passengerId' ";
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
/*-------------- requst TIRP --------------+ */
// ----------------  in order request change Case1 accept ---------------------------
public function changeTripCase1($case , $tripId,$userId, $driverName ){
    $this->db = new DBcontroller ;

    if($this->db->openConnection()){
        $query = "update `requesttrip` SET `cas`='$case' WHERE requestTrip = ' $tripId' ";
        $result = $this->db->update($query);
        //notifi
        $date = date('h-i-s');
        $description = $driverName . '   Accept your request Trip please check current trip';
        $query2 = " insert INTO `notifi`(`userId`, `description`, `date`) VALUES ('$userId',' $description ','$date')";
        $this->db->insert($query2);
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
// ----------------  in order request change Case2 reject  ---------------------------
public function changeTripCase2($userId , $tripId){
    $this->db = new DBcontroller ;

    if($this->db->openConnection()){
        //delete trip        
        $query = "delete FROM `requesttrip` WHERE requestTrip='$tripId' ";
        $result = $this->db->delete($query);
        // make driver avaliable 
        $query2 = "update `car` SET `cas`='' WHERE `userId`='$userId' ";
        $result = $this->db->update($query2);

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
// ---------------- in order requst change Case3 start trip ---------------------------
public function changeTripCase3($case , $tripId){
    $this->db = new DBcontroller ;

    if($this->db->openConnection()){
        $query = "update `requesttrip` SET `cas`='$case' WHERE requestTrip = ' $tripId' ";
        $result = $this->db->update($query);

        // set start time 
        $date = date('y-m-d-h-i-s');
        $query2 = "update `requesttrip` SET `sDate`='$date' WHERE `requestTrip`='$tripId'";
        $result = $this->db->update($query2);
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
// ---------------- in ordder requset change Case4 end trip---------------------------
public function changeTripCase4($case , $tripId){
    $this->db = new DBcontroller ;

    if($this->db->openConnection()){
        $query = "update `requesttrip` SET `cas`='$case' WHERE requestTrip = ' $tripId' ";
        $result = $this->db->update($query);
        // set end time 
        $date = date('y-m-d-h-i-s');
        $query2 = "update `requesttrip` SET `eDate`='$date' WHERE `requestTrip`='$tripId'";
        $result = $this->db->update($query2);
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
// ---------------- in ordder requset change Case5 Request to new trip trip---------------------------
public function changeTripCase5($userId , $tripId){
    $this->db = new DBcontroller ;

    if($this->db->openConnection()){
        $query = "update `requesttrip` SET `cas`=5 WHERE `requestTrip`='$tripId' ";
        $result = $this->db->update($query);
        // set end time 
        //$date = date('y-m-d-h-i-s');
        $query2 = "update `car` SET `cas`=0 WHERE `userId`='$userId'";
        $result = $this->db->update($query2);
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
/**    cancel trip by passenger */
public function cancelTripByuser($tripId){

    $this->db = new DBcontroller ;
    if($this->db->openConnection()){
        $query = "delete FROM `requesttrip` WHERE  `requestTrip` = '$tripId' ";
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



}






?>