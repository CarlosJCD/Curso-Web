<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;

$router = new Router();

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




// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
