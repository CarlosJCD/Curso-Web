<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;

$router = new Router();

$router->get('/', [LoginController::class, 'login'], false);
$router->post('/', [LoginController::class, 'login'], false);

$router->get('/logout', [LoginController::class, 'logout'], false);
$router->post('/logout', [LoginController::class, 'logout'], false);

$router->get('/crearCuenta', [LoginController::class, 'crearCuenta'], false);
$router->post('/crearCuenta', [LoginController::class, 'crearCuenta'], false);

$router->get('/olvidaContraseña', [LoginController::class, 'olvidaContraseña'], false);
$router->post('/olvidaContraseña', [LoginController::class, 'olvidaContraseña'], false);

$router->get('/cambiarContraseña', [LoginController::class, 'cambiarContraseña'], false);
$router->post('/cambiarContraseña', [LoginController::class, 'cambiarContraseña'], false);




// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
