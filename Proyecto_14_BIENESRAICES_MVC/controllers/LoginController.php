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
        }

        $router->display("auth/login", [
            "errores" => $errores
        ]);
    }
    public static function logout()
    {
        echo "logout";
    }
}
