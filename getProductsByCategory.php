<?php

    header('Content-type: application/json');
    require_once("Database.php");
    
    $D = new Database();
    $conn = $D->connect();
    $code = $_GET['code'];
    $res = Database::getProductsByCategory($conn, $code);
    echo $res;

?>
