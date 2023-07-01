<?php

namespace Controllers;

use Model\Registro;
use MVC\Router;

class RegistroController
{
    public static function crear(Router $router)
    {
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
                header("Location: /boleto?id=" . urlencode($registro->token));
            }
        }
    }
}
