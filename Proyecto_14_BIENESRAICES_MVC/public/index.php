<?php
require_once __DIR__ . "/../includes/app.php";

use Controllers\PaginasController;
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;

$router = new Router;


$router->asociarFuncionGET('/admin', [PropiedadController::class, 'index']);
$router->asociarFuncionGET('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->asociarFuncionPOST('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->asociarFuncionGET('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->asociarFuncionPOST('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->asociarFuncionPOST('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

$router->asociarFuncionGET('/vendedores/crear', [VendedorController::class, 'crear']);
$router->asociarFuncionPOST('/vendedores/crear', [VendedorController::class, 'crear']);
$router->asociarFuncionGET('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->asociarFuncionPOST('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->asociarFuncionPOST('/vendedores/eliminar', [VendedorController::class, 'eliminar']);

$router->asociarFuncionGET("/", [PaginasController::class, 'index']);
$router->asociarFuncionGET("/nosotros", [PaginasController::class, 'nosotros']);
$router->asociarFuncionGET("/propiedades", [PaginasController::class, 'propiedades']);
$router->asociarFuncionGET("/propiedad", [PaginasController::class, 'propiedad']);
$router->asociarFuncionGET("/blog", [PaginasController::class, 'blog']);
$router->asociarFuncionGET("/entrada", [PaginasController::class, 'entrada']);
$router->asociarFuncionGET("/contacto", [PaginasController::class, 'contacto']);


$router->comprobarRutas();
