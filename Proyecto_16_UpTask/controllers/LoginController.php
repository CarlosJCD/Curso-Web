<?php

namespace Controllers;

use AllowDynamicProperties;
use Model\Usuario;
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
        $usuario =  new Usuario();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario->sincronizar($_POST['cuenta']);
            $alertas = $usuario->validarNuevaCuenta($_POST['confirmarPassword']);
        }

        $router->render('auth/crearCuenta', [
            'titulo' => "Crear cuenta",
            'usuario' => $usuario,
            'errores' => $alertas['error'] ?? [],
            'exitos' => $alertas['exito'] ?? []
        ]);
    }

    public static function mensajeConfirmarCuenta(Router $router)
    {
        $router->render('auth/mensajeConfirmarCuenta', [
            'titulo' => "Confirma tu cuenta"
        ]);
    }

    public static function confirmarCuenta(Router $router)
    {
        $router->render('auth/confirmarCuenta', [
            'titulo' => "Cuenta confirmada"
        ]);
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
