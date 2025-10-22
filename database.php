<?php

class Database {

    public function Database() {
        
    }

    public static function connect() {
        try {
            $servername = "localhost:3306";
            $username = "root";
            $password = "";
            $database = "database";

            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function insertUser($U, $conn) {
        try {

            $conn->exec("set names 'utf8'");
            $sql = "insert into `users`(`username`,`password`,`email`) values";
            $sql .= "(";
            $sql .= "'" . $U->username . "',";
            $sql .= "'" . $U->password . "',";
            $sql .= "'" . $U->email . "')";
            $conn->exec($sql);
            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }
