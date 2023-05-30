<?php

use App\Clientes;
use App\Detalles;

include 'includes/header.php';


require 'clases/Clientes.php';
require 'clases/Detalles.php';

function mi_autoload($clase)
{
    require __DIR__ . '/clases/' . $clase . '.php';
}

spl_autoload_register('mi_autoload');

$detalles = new Detalles();
echo "<hr>";
$cliente = new Clientes();


include 'includes/footer.php';
