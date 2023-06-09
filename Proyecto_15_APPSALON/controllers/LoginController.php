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
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
        }

        $router->render("auth/crearCuenta", [
            'usuario' => $usuario,
            'alertas' => $alertas
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
