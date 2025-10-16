<?php
require_once("Database.php");
require_once("User.php");
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];


$U = new User($username, $password, $email);
if ($U->insert()==1){
    echo "{'result':1}";
}
else{
    echo "{'result':0}";
}
?>
