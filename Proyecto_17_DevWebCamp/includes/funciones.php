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

function validar_id($id)
{
    return filter_var($id, FILTER_VALIDATE_INT);
}
