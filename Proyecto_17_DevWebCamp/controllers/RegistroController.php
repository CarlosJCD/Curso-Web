<?php

namespace Controllers;

use MVC\Router;
use Model\Paquete;
use Model\Usuario;
use Model\Registro;

class RegistroController
{
    public static function crear(Router $router)
    {

        validarAuth("/");

        self::validarUsuarioYaRegistrado();

        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function gratis()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            validarAuth('/login');

            $token = substr(uniqid(rand(), true), 0, 8);

            $datos = array(
                'paquete_id' => 3,
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            );

            $registro = new Registro($datos);

            $resultado = $registro->guardar();
            if ($resultado) {
                header("Location: /boleto?token=" . urlencode($registro->token));
            }
        }
    }

    public static function boleto(Router $router)
    {
        $token = self::validarTokenBoleto();
        $registro = self::validarExistenciaRegistro($token);

        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);


        $router->render('registro/boleto', [
            'titulo' => 'Asistencia a DevWebCamp',
            'registro' => $registro
        ]);
    }

    private static function validarTokenBoleto()
    {
        $token = $_GET['token'];
        if (!$token || strlen($token) !== 8) {
            header("Location: /");
        }

        return $token;
    }

    private static function validarExistenciaRegistro($token)
    {
        $registro = Registro::where('token', $token);

        if (!$registro) {
            header("Location: /");
        }

        return $registro;
    }

    private static function validarUsuarioYaRegistrado()
    {
        $registro = Registro::where('usuario_id', $_SESSION['id']);

        if (isset($registro) && $registro->paquete_id === '3') {
            header("Location: /boleto?token=" . urlencode($registro->token));
        }
    }
}
