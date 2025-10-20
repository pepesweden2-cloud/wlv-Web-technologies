<?php

    header('Content-type: application/json');
    require_once("Database.php");
    
    $D = new Database();
    $conn = $D->connect();
    $res = Database::getAllCategories($conn);
    echo $res;

?>
