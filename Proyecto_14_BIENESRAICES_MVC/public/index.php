<?php
require_once __DIR__ . "/../includes/app.php";

use MVC\Router;
use Controllers\PropiedadController;

$router = new Router;


$router->asociarFuncionGET('/admin', [PropiedadController::class, 'index']);
$router->asociarFuncionGET('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->asociarFuncionGET('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);

$router->comprobarRutas();
