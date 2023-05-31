<?php



define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL',  __DIR__ . 'funciones.php');


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
