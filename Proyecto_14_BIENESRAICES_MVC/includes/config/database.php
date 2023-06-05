<?php

function conectarDB(): mysqli
{
    $conexion_db = new mysqli(hostname: 'localhost', username: 'root', password: "", database: "bienesraices");
    mysqli_set_charset($conexion_db, "utf8");
    if (!$conexion_db) {
        exit;
    }
    return $conexion_db;
}
