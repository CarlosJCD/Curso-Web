<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $router->render("auth/login");
    }

    public static function logout()
    {
    }

    public static function crearCuenta(Router $router)
    {
        $router->render("auth/crearCuenta");
    }

    public static function olvidaContraseña(Router $router)
    {
    }


    public static function cambiarContraseña(Router $router)
    {
    }
}
