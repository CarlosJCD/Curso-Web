<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\CitaController;
use Controllers\LoginController;
use Controllers\ServiciosController;
use MVC\Router;

$router = new Router();

$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);

$router->get('/logout', [LoginController::class, 'logout']);
$router->post('/logout', [LoginController::class, 'logout']);

$router->get('/crearCuenta', [LoginController::class, 'crearCuenta']);
$router->post('/crearCuenta', [LoginController::class, 'crearCuenta']);

$router->get('/confirmarCuenta', [LoginController::class, 'confirmarCuenta']);

$router->get('/olvidaContraseña', [LoginController::class, 'olvidaContraseña']);
$router->post('/olvidaContraseña', [LoginController::class, 'olvidaContraseña']);

$router->get('/cambiarContraseña', [LoginController::class, 'cambiarContraseña']);
$router->post('/cambiarContraseña', [LoginController::class, 'cambiarContraseña']);

$router->get('/mensaje', [LoginController::class, 'mensaje']);

$router->get('/cita', [CitaController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);

$router->get('/api/servicios', [APIController::class, 'index']);

$router->post('/api/citas', [APIController::class, 'guardar']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);


$router->get('/servicios', [ServiciosController::class, 'index']);
$router->get('/servicios/crear', [ServiciosController::class, 'crear']);
$router->post('/servicios/crear', [ServiciosController::class, 'crear']);
$router->get('/servicios/actualizar', [ServiciosController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServiciosController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServiciosController::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
