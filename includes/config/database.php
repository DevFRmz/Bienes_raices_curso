<?php
$host = 'localhost';
$db = 'bienesraices_app';
$user = 'root';
$password = 'FelipeRmz082001.';

try{

    $conn = new PDO("mysql:host=$host; dbname=$db", $user, $password);

} catch(PDOException $error) {

    die ("Error al conectar con la base de datos {$error->getMessage()}");
    
}
