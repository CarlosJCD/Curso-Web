<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        }

        $router->render('auth/login', [
            'titulo' => "Iniciar Sesión"
        ]);
    }

    public static function logout()
    {
    }

    public static function crearCuenta(Router $router)
    {
        $router->render('auth/crearCuenta', [
            'titulo' => "Crear cuenta"
        ]);
    }

    public static function mensajeConfirmarCuenta()
    {
    }

    public static function confirmarCuenta()
    {
    }

    public static function olvidaPassword()
    {
    }

    public static function restablecePassword()
    {
    }
}
