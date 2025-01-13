<?php
//Adatbázishoz csatlakozás
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "allatorokbefogado";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if(!$conn){
    die("Valami hiba történt: ".mysqli_connect_error());
}

$conn -> set_charset("utf8");
?>