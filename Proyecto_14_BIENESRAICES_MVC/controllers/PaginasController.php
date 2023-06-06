<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;

class PaginasController
{
    public static function index(Router $router)
    {
        $router->display('paginas/index', [
            'inicio' => true,
            'propiedades' => Propiedad::get(3)
        ]);
    }
    public static function nosotros(Router $router)
    {
    }
    public static function propiedades(Router $router)
    {
    }
    public static function propiedad(Router $router)
    {
    }
    public static function blog(Router $router)
    {
    }
    public static function entrada(Router $router)
    {
    }
    public static function contacto(Router $router)
    {
    }
}
