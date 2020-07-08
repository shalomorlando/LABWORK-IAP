<?php

include_once 'DBConnector.php';
include "../interfaces/crud.php";
include "../interfaces/authenticate.php";

class User implements Crud, Authenticator{

    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;
    private $file_name;
    private $conn;
    
    private $username;
    private $password;

    public function __construct(){
        $this->first_name = '';
        $this->last_name = '';
        $this->city_name = '';
        $this->username = '';
        $this->password = '';
        $this->conn = new DBConnector;
    }

    public static function create(){
        $instance = new self();
        return $instance;
    }

    function createNewUser($first_name, $last_name,$city, $username, $password, $file_name){

        $this->setFirstName($first_name);
        $this->setLastName($last_name);
        $this->setCityName($city);
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setFileName($file_name);
        
        return $this;
    }

    //user id setter
    public function setUserId ($user_id){
        $this->user_id = $user_id;
        return $this;
    }    

    //username setter
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }
    //password setter
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }
    //set first_name 
    public function setFirstName($first_name){
        $this->first_name = $first_name;
        return $this;
    }

    //set last name
    public function setLastName($last_name){
        $this->last_name = $last_name;
        return $this;
    }

    //set city name
    public function setCityName($city_name){
        $this->city_name = $city_name;
        return $this;
    }

    public function setFileName($file_name){
        $this->file_name = $file_name;
        return $this;
    }

    //user id getter
    public function getUserId() {
        return $this->user_id;
    }

    //username getter 
    public function getUsername(){
        return $this->username;
    }

    //password getter
    public function getPassword(){
        return $this->password;
    }

    //first name getter
    public function getFirstName(){
        return $this->first_name;
    }

    //last name getter
    public function getLastName(){
        return $this->last_name;
    }

    //city name getter
    public function getCityName(){
        return $this->city_name;
    }

    //uploaded file name getter
    public function getFileName(){
        return $this->file_name;
    }


    public function save(){
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;
        $uname = $this->username;
        $fileName = $this->file_name;

        $this->hashPassword();

        $pass = $this->password;
        $exist = $this->isUserExist();

        if(!$exist){
            echo "Sorry the Username already exists </br>";
        }else{
            $sql = "INSERT INTO users (id,first_name,last_name,user_city,username,password, image) VALUES(DEFAULT,'".$fn."','".$ln."','".$city."','".$uname."','".$pass."', '".$fileName."')";

            if ($this->conn->conn->query($sql)){
                return "successful";
            } else {
                return null;
            }
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

    public function validateForm(){
        //Return true if the value are not empty
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;
        $username = $this->username;
        $password = $this->password;

        if($fn == "" || $ln = "" || $city = "" || $username = "" || $password = ""){
            return false;
        }
        return true;
    }

    public function createFormErrorSessions(){
        session_start();
        $_SESSION['form_errors'] = "all fields are required";
    }

    public function createUserNameAlreadyExistsError(){
        session_start();
        $_SESSION['form_errors'] = "The Username already Exists";
    }

    public function hashPassword(){
        //function to hash the password
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function isPasswordCorrect(){
        $found = false;
        $res = $this->conn->conn->query("SELECT * FROM users");

        if (!$res) {
            echo("Error description: " . $this->conn->conn->error);
        }

        if ($res->num_rows > 0) {
            // output data of each row
            while($row = $res->fetch_assoc()) {
                if(password_verify($this->getPassword(), $row["password"]) && $this->getUsername() == $row["username"]){
                    $found = true;
                }
            }
        } else {
            echo "0 results";
        }

        return $found;
        
    }

    public function login(){
        if($this->isPasswordCorrect()){
            header("Location:private_page.php");
        }
    }

    public function createUserSession(){
        session_start();
        $_SESSION['username'] = $this->getUsername();

    }

    public function logout(){
        session_start();
        unset($_SESSION['username']);
        session_destroy();
        header("Location:Login.php");
    }

    public function isUserExist(){
        //return false if username already exists
        $res = $this->readAll();

        //check if query was successful 
        if(!$res) {
            echo("Error description: " .$this->conn->conn->error); 
        }


        //check if the number of rows in the result set is greater than 0
        if ($res->num_rows > 0){

            //loop through each row of the result set
            while($row = $res->fetch_assoc()){
                if($this->getUsername() == $row ["username"]){
                    echo "This user name already exists";
                    return false;
                }
            }

        }

        return true;
    }

}
?>