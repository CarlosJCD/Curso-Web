<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{
    public static function login(Router $router)
    {
        $errores = Admin::getErrores();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Admin($_POST['usuario']);

            $errores = $usuario->validar();
            if (empty($errores)) {
                $usuario->autenticar();
            }
        }

        $router->display("auth/login", [
            "errores" => $errores
        ]);
    }
    public static function logout()
    {
        session_start();

        $_SESSION = [];

        header("Location: /");
    }
}
