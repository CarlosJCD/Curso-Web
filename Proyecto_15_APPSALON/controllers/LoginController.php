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
            if (!isset($alertas['error']) || empty($alertas['error'])) {
                $usuario->hashContraseña();
                $usuario->crearToken();
                self::emailConfirmacionCrearCuenta($usuario);

                $resultado = $usuario->guardar();

                if ($resultado) {
                    header("Location: /mensaje");
                }
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
        $email->enviarConfirmacion();
    }

    public static function mensaje(Router $router)
    {
        $router->render("auth/mensaje");
    }

    public static function confirmarCuenta(Router $router)
    {
        $alertas = [];
        $token = s($_GET['token']);

        $usuario = Usuario::where("token", $token);
        $router->render("auth/confirmarCuenta", [
            'alertas' => $alertas,
            'token' => $token,
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
