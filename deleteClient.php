<?php

if(isset($_GET["id"])){
    $id = $_GET["id"];

$serverName = 'localhost';
$userName = 'root';
$password = '';
$dbname = 'myshop1';

$connexion = new mysqli($serverName, $userName, $password, $dbname); 

$sql = "DELETE FROM clients1 WHERE id=$id";
$connexion->query($sql);

}
    header('location: /myShop/index.php');
    exit;

?>