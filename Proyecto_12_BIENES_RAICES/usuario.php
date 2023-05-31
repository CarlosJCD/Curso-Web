<?php

require "includes/app.php";

$db = conectarDB();

$email = "correo@ejemplo.com";
$password = "contraseña";

$password_hash = password_hash($password, PASSWORD_DEFAULT);

echo '<pre>';
var_dump($password_hash);
echo '</pre>';

$query = "INSERT INTO usuarios (email,password) VALUES ('$email', '$password_hash')";


echo $query;


mysqli_query($db, $query);
