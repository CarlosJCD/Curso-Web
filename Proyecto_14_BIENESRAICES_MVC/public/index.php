<?php
require_once __DIR__ . "/../includes/app.php";

use Controllers\EntradaBlogController;
use Controllers\LoginController;
use Controllers\PaginasController;
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;

$router = new Router;


$router->asociarFuncionGET('/admin', [PropiedadController::class, 'index'], true);
$router->asociarFuncionGET('/propiedades/crear', [PropiedadController::class, 'crear'], true);
$router->asociarFuncionPOST('/propiedades/crear', [PropiedadController::class, 'crear'], true);
$router->asociarFuncionGET('/propiedades/actualizar', [PropiedadController::class, 'actualizar'], true);
$router->asociarFuncionPOST('/propiedades/actualizar', [PropiedadController::class, 'actualizar'], true);
$router->asociarFuncionPOST('/propiedades/eliminar', [PropiedadController::class, 'eliminar'], true);

$router->asociarFuncionGET('/vendedores/crear', [VendedorController::class, 'crear'], true);
$router->asociarFuncionPOST('/vendedores/crear', [VendedorController::class, 'crear'], true);
$router->asociarFuncionGET('/vendedores/actualizar', [VendedorController::class, 'actualizar'], true);
$router->asociarFuncionPOST('/vendedores/actualizar', [VendedorController::class, 'actualizar'], true);
$router->asociarFuncionPOST('/vendedores/eliminar', [VendedorController::class, 'eliminar'], true);

$router->asociarFuncionGET('/entradasBlog/crear', [EntradaBlogController::class, 'crear'], true);
$router->asociarFuncionPOST('/entradasBlog/crear', [EntradaBlogController::class, 'crear'], true);
$router->asociarFuncionGET('/entradasBlog/actualizar', [EntradaBlogController::class, 'actualizar'], true);
$router->asociarFuncionPOST('/entradasBlog/actualizar', [EntradaBlogController::class, 'actualizar'], true);
$router->asociarFuncionPOST('/entradasBlog/eliminar', [EntradaBlogController::class, 'eliminar'], true);

$router->asociarFuncionGET("/", [PaginasController::class, 'index'], false);
$router->asociarFuncionGET("/nosotros", [PaginasController::class, 'nosotros'], false);
$router->asociarFuncionGET("/propiedades", [PaginasController::class, 'propiedades'], false);
$router->asociarFuncionGET("/propiedad", [PaginasController::class, 'propiedad'], false);
$router->asociarFuncionGET("/blog", [PaginasController::class, 'blog'], false);
$router->asociarFuncionGET("/entrada", [PaginasController::class, 'entrada'], false);
$router->asociarFuncionGET("/contacto", [PaginasController::class, 'contacto'], false);
$router->asociarFuncionPOST("/contacto", [PaginasController::class, 'contacto'], false);

$router->asociarFuncionGET('/login', [LoginController::class, "login"], false);
$router->asociarFuncionPOST('/login', [LoginController::class, "login"], false);
$router->asociarFuncionGET('/logout', [LoginController::class, "logout"], false);



$router->comprobarRutas();
