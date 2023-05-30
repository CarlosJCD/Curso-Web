<?php

require 'app.php';

function añadirPlantilla($nombrePlantilla, $inicio = false)
{
    include TEMPLATES_URL . "/{$nombrePlantilla}.php";
}

function estadoAutenticado(): bool
{
    session_start();
    if (!isset($_SESSION["login"])   || !$_SESSION["login"]) {
        return false;
    }
    return true;
}
