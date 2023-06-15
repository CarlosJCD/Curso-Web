<?php

namespace Controllers;

use MVC\Router;

class ServiciosController
{
    public static function index(Router $router)
    {
        $router->render("servicios/index");
    }
    public static function crear(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
    }
    public static function actualizar(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
    }
    public static function eliminar(Router $router)
    {
    }
}
