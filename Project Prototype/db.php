<?php 
 
$hostname = "localhost";
$dbname = "findjob_db";
$username = "root";
$password = "1855";


try{
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("ERROR : " . $e->getMessage());
}


?>