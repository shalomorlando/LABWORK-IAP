<?php
include_once 'DBConnector.php';
include "crud.php";



class User implements Crud {

    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;
    private $conn;

    function __construct($first_name,$last_name,$city_name){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->city_name = $city_name;
        $this->conn = new DBConnector;

    }

    //user id setter
    public function setUserId ($user_id){
        $this->user_id = $user_id;
    }

    //user id getter
    public function getUserId() {
        return $this->user_id;
    }

    public function save(){
        $fn = $this -> first_name;
        $ln = $this -> last_name;
        $city = $this -> city_name;
        $sql = "INSERT INTO users (id,first_name,last_name,user_city) VALUES(DEFAULT,'".$fn."','".$ln."','".$city."')";

        if ($this->conn->conn->query($sql)){
            return "successful";
        } else {
            return null;
        }
    }

    public function readAll(){
        $sql = "SELECT * FROM users";
        $result = $this->conn->conn->query($sql);
        return $result;
    }

    public function readUnique(){
        return null;
    }

    public function search(){
        return null;
    }

    public function update(){
        return null;
    }

    public function removeOne(){
        return null;
    }

    public function removeAll(){
        return null;
    }
}

?>