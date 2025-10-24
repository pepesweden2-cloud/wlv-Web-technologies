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

    public static function manufacturerCount($conn) {
        try {
            $conn->exec("set names 'utf8'");
            $sql = "select count(*) as c from `manufacturer`";
            $c = 0;
            foreach ($conn->query($sql) as $row) {
                $c = $row['c'];
            }
            return "{\"count\":$c}";
        } catch (Exception $e) {
            return $e->getMessage() . "{'count':-1}";
        }
    }
    
    public static function getAllCategories($conn) {
        try {
            $conn->exec("set names 'utf8'");
            
            $sql = "SELECT distinct `id` as `code`, `description` FROM `catagories` WHERE 1";

            $records = array();
            foreach ($conn->query($sql) as $row) {
                array_push($records, $row);
            }
            return json_encode($records);
        } catch (Exception $e) {
            return $e->getMessage() . "{'count':-1}";
        }
    }
    
    public static function getOrders($conn) {
        try {
            $conn->exec("set names 'utf8'");
            $sql = "select `orderID`,`pricedata`.`productID` as productID,`username`,`quantity`,`when`,`description`,`price` from `orders`,`pricedata` where `orders`.`productID` = `pricedata`.`productID`  order by `when` desc";
            $records = array();
            foreach ($conn->query($sql) as $row) {
                array_push($records, $row);
            }
            return json_encode($records);
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }
	
    public static function login($conn, $username, $password){
        try {
            $conn->exec("set names 'utf8'");
			$sql = "SELECT `users`.`username` as username,`password`,`email`,IFNULL(`manufacturer`.`id`,0) as gasstationID FROM `users` left join `manufacturer` on `users`.`username`=`manufacturer`.`username` WHERE `users`.`username`='$username' and `password`='$password'";
            $stmt = $conn->query($sql);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($records as $record) {
                return $record;
            }
            return null;
        } catch (Exception $e) {
            return null;
        }
        
    }
    
    public static function changePrice($conn, $productid, $price){
        try {
            $conn->exec("set names 'utf8'");
			$sql = "update `products` set `price`=$price where  `id` = $productid";
            $stmt = $conn->exec($sql);
            echo $sql;
            return 1;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function getAllManufacturers($conn) {
        try {
            $conn->exec("set names 'utf8'");
			$sql = "SELECT `id`, `description`, `municipalityID`, `municipalityName`, `countyID`, `countyName`, `address`, `phone1` FROM `manufacturer` WHERE 1";
            $records = array();
            foreach ($conn->query($sql) as $row) {
                array_push($records, $row);
            }
            return json_encode($records);
        } catch (Exception $e) {

            return null;
        }
    }
    
    public static function placeOrder($conn, $username, $product, $quantity){
        
        try{
            $conn->exec("set names 'utf8'");
			$sql = "INSERT INTO `orders` (`productID`, `username`, `quantity`, `when`) VALUES ";
            $sql.="( '$product', '$username', '$quantity', CURRENT_TIMESTAMP)";
            $conn->exec($sql);
        }
        catch (Exception $e) {

            return $e->getMessage();
        }
    }

    public static function getPriceTable($conn, $c) {
        try {
            $conn->exec("set names 'utf8'");
			$sql = "SELECT `id`,`description`,`price` FROM products WHERE `category` = ";
            $sql .= $c;

            $records = array();
            foreach ($conn->query($sql) as $row) {
                array_push($records, $row);
            }
            return json_encode($records);
        } catch (Exception $e) {

            return null;
        }
    }

  

}
