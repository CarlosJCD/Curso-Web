<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\DashboardController;
use Controllers\LoginController;
use Controllers\TareaController;
use MVC\Router;

$router = new Router();

# -- RUTAS LOGIN CONTROLLER --

$router->get("/", [LoginController::class, "login"]);
$router->post("/", [LoginController::class, "login"]);

$router->get("/logout", [LoginController::class, "logout"]);

$router->get("/crearCuenta", [LoginController::class, "crearCuenta"]);
$router->post("/crearCuenta", [LoginController::class, "crearCuenta"]);

$router->get("/mensajeConfirmarCuenta", [LoginController::class, "mensajeConfirmarCuenta"]);

$router->get("/confirmarCuenta", [LoginController::class, "confirmarCuenta"]);

$router->get("/olvidaPassword", [LoginController::class, "olvidaPassword"]);
$router->post("/olvidaPassword", [LoginController::class, "olvidaPassword"]);

$router->get("/restablecePassword", [LoginController::class, "restablecePassword"]);
$router->post("/restablecePassword", [LoginController::class, "restablecePassword"]);

// -- RUTAS DASHBOARD CONTROLLER --
$router->get("/dashboard", [DashboardController::class, "index"]);

$router->get("/crearProyecto", [DashboardController::class, "crearProyecto"]);
$router->post("/crearProyecto", [DashboardController::class, "crearProyecto"]);

$router->get("/proyecto", [DashboardController::class, "proyecto"]);

$router->get("/perfil", [DashboardController::class, "perfil"]);
$router->post("/perfil", [DashboardController::class, "perfil"]);

$router->get("/cambiarPassword", [DashboardController::class, "cambiar_password"]);
$router->post("/cambiarPassword", [DashboardController::class, "cambiar_password"]);

// -- RUTAS TAREA CONTROLLER --

$router->get('/api/tareas', [TareaController::class, 'index']);
$router->post('/api/tarea', [TareaController::class, 'crear']);
$router->post('/api/tarea/actualizar', [TareaController::class, 'actualizar']);
$router->post('/api/tarea/eliminar', [TareaController::class, 'eliminar']);


// Valida y ejecuta las metodos de los controladores asociados a la ruta solicitada.
$router->comprobarRutas();
