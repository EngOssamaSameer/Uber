<?php

class DBcontroller{
    public $dbHost = "localhost";
    public $dbUser = "root";
    public $dbPassword = "";
    public $dbName = "uber";
    public $connection ;


    // function DBcontroller to open database
    public function openConnection(){
        $this->connection = new mysqli($this->dbHost,$this->dbUser,$this->dbPassword,$this->dbName); 
        //$this->connection = new mysqli("localhost","root","","demo"); 
        if($this->connection->connect_error){
            echo"connection error";
            return false;
        }else{
            return true;
        }
           
    }

    // function DBcontroller to close database
    public function closeConnection(){
        if($this->connection){
            $this->connection->close();
        }else{
            echo 'connection is not opened';
        }
    }
    //function to select form db
    public function select($query){
        $result = $this->connection->query($query);
        if(! $result){
            return false;
        }else{
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    //function insert into db
    public function insert($query){
        $result = $this->connection->query($query);
        if(! $result){
            return false;
        }else{
            return $this->connection->insert_id;
        }
    }

    //function delete form  db
    public function delete($query){
        $result = $this->connection->query($query);
        if(! $result){
            return false;
        }else{
            return true ;
        }
    }
    //function update in  db
    public function update($query){
        $result = $this->connection->query($query);
        if(! $result){
            return false;
        }else{
            return true ;
        }
    }

}








?>