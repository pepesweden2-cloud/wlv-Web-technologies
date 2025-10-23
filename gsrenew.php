<?php
    require_once("Database.php");
    $D = new Database();
    $conn = $D->connect();
    $res = Database::manufacturerCount($conn);
    echo $res;
?>


