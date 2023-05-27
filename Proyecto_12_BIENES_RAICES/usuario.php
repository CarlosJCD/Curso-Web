<?php

require "includes/config/database.php";

$db = conectarDB();

$email = "correo@ejemplo.com";
$password = "contraseña";

$query = "INSERT INTO usuarios (email,password) VALUES ('$email', '$password')";

echo $query;
mysqli_query($db, $query);
