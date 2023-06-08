<?php



define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL',  __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenesPropiedades/');
define('CARPETA_IMAGENES_ENTRADAS', $_SERVER['DOCUMENT_ROOT'] . '/imagenesEntradas/');



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
    $tipos = ['vendedor', 'propiedad', "entrada"];
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
