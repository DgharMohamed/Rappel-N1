<?php 
 
$hostname = "localhost";
$dbname = "FindJob_db";
$username = "root";
$password = "";



try{
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    "ERROR : ". $e->getMessage();
}


?>