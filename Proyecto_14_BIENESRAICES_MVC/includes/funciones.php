<?php



define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL',  __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenesPropiedades/');



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

function filtrarHtml($string)
{
    return htmlspecialchars($string);
}

function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

function validarORedireccionar($url)
{
    $id = $_GET['id'];

    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: $url");
    }
    return $id;
}
