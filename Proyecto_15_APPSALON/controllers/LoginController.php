<?php

namespace Controllers;

use Classes\Email;
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
            if (!isset($alertas['errores']) || empty($alertas['errores'])) {
                $usuario->hashContraseña();

                self::emailConfirmacionCrearCuenta($usuario);

                debuguear($usuario);
            }
        }

        $router->render("auth/crearCuenta", [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    private static function emailConfirmacionCrearCuenta(Usuario $usuario)
    {
        $email = new Email(email: $usuario->email, token: $usuario->token, nombre: $usuario->nombre);
    }

    public static function olvidaContraseña(Router $router)
    {
        $router->render("auth/olvidaContraseña");
    }

    public static function cambiarContraseña(Router $router)
    {
    }
}
