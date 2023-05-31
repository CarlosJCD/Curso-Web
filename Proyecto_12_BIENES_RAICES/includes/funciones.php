<?php



define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL',  __DIR__ . 'funciones.php');


function añadirPlantilla($nombrePlantilla, $inicio = false)
{
    include TEMPLATES_URL . "/{$nombrePlantilla}.php";
}

function validarAcceso(): void
{
    session_start();
    if (!isset($_SESSION["login"]) || !$_SESSION["login"]) {
        header('Location: /');
    }
}
