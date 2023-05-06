<?php

require 'app.php';

function añadirPlantilla($nombrePlantilla, $inicio = false)
{
    include TEMPLATES_URL . "/{$nombrePlantilla}.php";
}
