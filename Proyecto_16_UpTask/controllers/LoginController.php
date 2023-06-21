<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validacionLogin();
            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);
                session_start();
                $_SESSION['id'] = $usuario->id;
                $_SESSION['nombre'] = $usuario->nombre;
                $_SESSION['email'] = $usuario->email;
                $_SESSION['login'] = true;

                header('Location: /dashboard');
            }
        }

        $router->render('auth/login', [
            'titulo' => "Iniciar Sesión",
            'errores' => $alertas['error'] ?? []
        ]);
    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
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
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmailExistente();
            if (empty($alertas)) {

                $usuario = Usuario::where('email', $usuario->email);
                $usuario->token = uniqid();
                $usuario->guardar();

                $email = new Email(nombre: $usuario->nombre, email: $usuario->email, token: $usuario->token);
                $email->emailReestablecerContraseña();

                $alertas['exito'][] = "Se ha enviado un email para reestablecer tu contraseña";
            }
        }

        $router->render('auth/olvidaPassword', [
            'titulo' => "Reestablece Contraseña",
            'errores' => $alertas['error'] ?? [],
            'exitos' => $alertas['exito'] ?? []
        ]);
    }

    public static function restablecePassword(Router $router)
    {
        $token = s($_GET['token'] ?? '');
        $usuario = Usuario::where('token', $token);
        if (!$token || empty($usuario)) {
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarContraseñaNueva();
            if (empty($alertas)) {
                $usuario->password = password_hash($usuario->password, PASSWORD_BCRYPT);

                $usuario->token = '';

                $resultado = $usuario->guardar();

                if ($resultado) {
                    header('Location: /');
                }
            }
        }
        $router->render('auth/reestablecePassword', [
            'titulo' => "Reestablece Contraseña",
            'errores' => $alertas['error'] ?? [],
            'exitos' => $alertas['exito'] ?? []
        ]);
    }
}
