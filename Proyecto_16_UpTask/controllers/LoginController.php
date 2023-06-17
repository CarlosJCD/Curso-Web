<?php

namespace Controllers;

use Classes\Email;
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
            if (empty($alertas) && $usuario->crearCuenta()) {
                $email = new Email(nombre: $usuario->nombre, email: $usuario->email, token: $usuario->token);
                $email->enviarConfirmacion();
                header('Location: /mensajeConfirmarCuenta');
            }
        }

        $router->render('auth/crearCuenta', [
            'titulo' => "Crear cuenta",
            'usuario' => $usuario,
            'errores' => $alertas['error'] ?? [],
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
        $token = s($_GET['token'] ?? '');
        $usuario = Usuario::where('token', $token);
        if (!$token || empty($usuario)) {
            Usuario::setAlerta('error', 'Token invalido');
        } else {
            $usuario->confirmado = 1;
            $usuario->token = "";
            $usuario->guardar();
            Usuario::setAlerta('exito', "¡Felicidades, has creado exitosamente tu cuenta de uptask!");
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmarCuenta', [
            'titulo' => "Cuenta confirmada",
            'errores' => $alertas['error'] ?? [],
            'exitos' => $alertas['exito'] ?? []
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
