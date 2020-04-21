<?php

define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS',  '');
define('DB_NAME','btc3205');

class DBConnector {
    public $conn;

    function __construct(){
        $this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }  
    }

    public function closeDatabase(){
        $this->conn->close();
    }
}

?>