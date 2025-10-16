<?php


class User {
    var $username;
    var $password;
    var $email;
    
    public function __construct($username, $password, $email) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    public function insert(){
        $D = new Database();
        $conn = $D->connect();
        return $D->insertUser($this, $conn);
    }
    
}
