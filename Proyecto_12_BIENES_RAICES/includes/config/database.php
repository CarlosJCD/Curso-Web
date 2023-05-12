<?php

function conectarDB(): mysqli
{
    $conexion_db = mysqli_connect(hostname: 'localhost', username: 'root', password: "", database: "bienesraices");
    if (!$conexion_db) {
        exit;
    }
    return $conexion_db;
}
