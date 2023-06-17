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

    public static function mensajeConfirmarCuenta(Router $router)
    {
        $router->render('auth/mensajeConfirmarCuenta', [
            'titulo' => "Confirma tu cuenta"
        ]);
    }

    public static function confirmarCuenta()
    {
    }

    public static function olvidaPassword(Router $router)
    {
        $router->render('auth/olvidaPassword', [
            'titulo' => "Reestablece Contraseña"
        ]);
    }

    public static function restablecePassword(Router $router)
    {
        $router->render('auth/reestablecePassword', [
            'titulo' => "Reestablece Contraseña"
        ]);
    }
}
