<?php


function desplegarError($error)
{
    echo "<div class='alerta error'>$error</div>";
}

function desplegarExito($exito)
{
    echo "<div class='alerta exito'>$exito</div>";
}

if ($errores) {
    foreach ($errores as $error) {
        desplegarError($error);
    }
} elseif ($exitos) {
    foreach ($exitos as $exito) {
        desplegarExito($exito);
    }
}
