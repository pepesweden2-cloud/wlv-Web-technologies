<?php
    require_once("Database.php");
    $product = $_POST['product'];
    $username = $_POST['username'];
    $quantity = $_POST['quantity'];

    print_r($_POST);
    $conn = Database::connect();
    Database::placeOrder($conn, $username, $product, $quantity);
?>
