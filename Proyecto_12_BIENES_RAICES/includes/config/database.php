<?php

function conectarDB(): mysqli
{
    $conexion_db = mysqli_connect('localhost', 'root', "", "bienesraices");
    if (!$conexion_db) {
        exit;
    }
    return $conexion_db;
}
