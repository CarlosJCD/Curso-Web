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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['id'] = $usuario->id;
                $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                $_SESSION['email'] = $usuario->email;
                $_SESSION['login'] = true;

                if ($usuario->admin === "1") {
                    $_SESSION['admin'] = $usuario->admin;
                }

                header("Location: /cita");
            }
        }
        $router->render("auth/login", [
            "alertas" => $alertas
        ]);
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
        $token = s($_GET['token']);
        $usuario = Usuario::where("token", $token);
        if (empty($usuario) || $token == "") {
            Usuario::setAlerta('error', "Token Invalido");
        } else {
            $usuario->confirmado = 1;
            $usuario->token = "";
            $usuario->guardar();
            Usuario::setAlerta('exito', "Cuenta comprobada correctamente");
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/confirmarCuenta", [
            'alertas' => $alertas,
            'token' => $token,
        ]);
    }


    public static function olvidaContraseña(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarRecuperarContraseña();
            if (empty($alertas['error'])) {
                $usuario = Usuario::where('email', $auth->email);
                $usuario->crearToken();
                $usuario->guardar();

                self::emailCambiarContraseña($usuario);
            }
        }
        $router->render("auth/olvidaContraseña", [
            'alertas' => $alertas
        ]);
    }

    private static function emailCambiarContraseña(Usuario $usuario)
    {
        $email = new Email(nombre: $usuario->nombre, email: $usuario->email, token: $usuario->token);
        $email->enviarInstruccionesCambiarContraseña();
    }

    public static function cambiarContraseña(Router $router)
    {
        $alertas = [];

        $token = s($_GET['token']);
        $usuario = Usuario::where("token", $token);

        if (!$token || empty($usuario)) {
            Usuario::setAlerta("error", "Token No Valido");
            unset($usuario);
        }
        $alertas = Usuario::getAlertas();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();
            if (empty($alertas['error'])) {

                $usuario->password = $password->password;
                $usuario->hashContraseña();
                $usuario->token = "";

                $resultado = $usuario->guardar();
                if ($resultado) {
                    header("Location: /");
                }
            }
        }


        $router->render("auth/cambiarContraseña", [
            'alertas' => $alertas,
            'usuario' => $usuario ?? null
        ]);
    }
}
