<?php
    header('Content-type: application/json');
    require_once("Database.php");
    $code = $_POST['code'];
    $price = $_POST['price'];
    $D = new Database();
    $conn = $D->connect();
    $res = Database::changePrice($conn, $code, $price);
    echo $res;
    
?>
