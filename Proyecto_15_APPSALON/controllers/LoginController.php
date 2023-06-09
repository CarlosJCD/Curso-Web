<?php

namespace Controllers;

use Model\Usuario;
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
        $usuario = new Usuario;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
        }
        $router->render("auth/crearCuenta", [
            'usuario' => $usuario
        ]);
    }

    public static function olvidaContraseña(Router $router)
    {
        $router->render("auth/olvidaContraseña");
    }


    public static function cambiarContraseña(Router $router)
    {
    }
}
