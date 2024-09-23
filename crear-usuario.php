<?php
//Delete me for production (only for development)

require 'includes/config/database.php';

$email = 'prueba@correo.com';
$password = 'prueba123';


$passwordHash = password_hash($password, PASSWORD_BCRYPT);

$query = "INSERT INTO usuarios (email, password) VALUES ('{$email}', '{$passwordHash}')";

$conn->query($query);