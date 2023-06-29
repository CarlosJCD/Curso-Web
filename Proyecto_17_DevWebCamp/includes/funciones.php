<?php

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

function pagina_actual($path): bool
{
    return (str_contains($_SERVER['PATH_INFO'], $path)) ? true : false;
}

function enlace_actual($path): string
{
    return pagina_actual($path) ? 'dashboard__enlace--actual' : '';
}

function validar_id($id, $url_redireccionamiento)
{
    $id_filtrado = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id_filtrado) {
        header("Location: $url_redireccionamiento");
        return;
    }

    return $id_filtrado;
}

function validarAuth($url_redireccionamiento)
{
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!(isset($_SESSION['nombre']) && !empty($_SESSION))) {
        header("Location: $url_redireccionamiento");
    }
}

function validarAdmin($url_redireccionamiento)
{
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!(isset($_SESSION['admin']) && !empty($_SESSION['admin']))) {
        header("Location: $url_redireccionamiento");
    }
}
