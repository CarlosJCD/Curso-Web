<?php


function desplegarError($error)
{
    echo "<div class='alerta error'>$error</div>";
}

function desplegarExito($exito)
{
    echo "<div class='alerta exito'>$exito</div>";
}

if (isset($errores) && !empty($errores)) {
    foreach ($errores as $error) {
        desplegarError($error);
    }
} elseif (isset($exitos) && !empty($exitos)) {
    foreach ($exitos as $exito) {
        desplegarExito($exito);
    }
}
