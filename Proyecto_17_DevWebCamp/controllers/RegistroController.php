<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Paquete;
use Model\Ponente;
use Model\Usuario;
use Model\Registro;
use Model\Categoria;
use Model\Regalo;

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

    public static function conferencias(Router $router)
    {
        validarAuth("/login");

        $registro = self::validarRegistroPresencial($_SESSION['id']);

        $eventos = self::obtenerEventosOrdenados();

        $regalos = Regalo::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            validarAuth("/login");

            $eventos_id = explode(",", $_POST["eventos"]);

            if (empty($eventos_id)) {
                header('Content-type: application/json');
                echo json_encode(['resultado' => false]);
                return;
            }

            $registro = Registro::where('usuario_id', $_SESSION['id']);

            if (!$registro || $registro->paquete_id !== '1') {
                header('Content-type: application/json');
                echo json_encode(['resultado' => false]);
                return;
            }

            self::validarDisponibilidadEventos($eventos_id);
        }

        $router->render('registro/conferencias', [
            'titulo' => 'Elige Workshops y Conferencias',
            'registro' => $registro,
            'eventos' => $eventos,
            'regalos' => $regalos
        ]);
    }

    public static function pagar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            validarAuth('/login');

            if (empty($_POST)) {
                echo json_encode([]);
                return;
            }

            $datos = $_POST;
            $datos['token'] = substr(md5(uniqid(rand(), true)), 0, 8);
            $datos['usuario_id'] = $_SESSION['id'];

            try {
                $registro = new Registro($datos);

                $resultado = $registro->guardar();

                header('Content-Type: application/json');
                echo json_encode($resultado);
            } catch (\Throwable $th) {
                echo json_encode([
                    'resultado' => 'error'
                ]);
            }
        }
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

        if (isset($registro) && $registro->paquete_id !== '') {
            header("Location: /boleto?token=" . urlencode($registro->token));
        }
    }

    private static function validarRegistroPresencial($usuario_id)
    {
        $registro = Registro::where('usuario_id', $usuario_id);

        if ($registro->paquete_id != 1) {
            header('Location: /');
        }

        return $registro;
    }

    private static function obtenerEventosOrdenados()
    {
        $eventos = Evento::ordenar('hora_id');
        $eventosOrdenados = [
            'conferencias_viernes' => [],
            'conferencias_sabado' => [],
            'workshops_viernes' => [],
            'workshops_sabado' => []
        ];

        foreach ($eventos as $evento) {

            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);

            switch (true) {
                case $evento->dia_id === '1' && $evento->categoria_id === '1':
                    $eventosOrdenados['conferencias_viernes'][] = $evento;
                    break;
                case $evento->dia_id === '1' && $evento->categoria_id === '2':
                    $eventosOrdenados['workshops_viernes'][] = $evento;
                    break;
                case $evento->dia_id === '2' && $evento->categoria_id === '1':
                    $eventosOrdenados['conferencias_sabado'][] = $evento;
                    break;
                case $evento->dia_id === '2' && $evento->categoria_id === '2':
                    $eventosOrdenados['workshops_sabado'][] = $evento;
                    break;
                default:
                    debuguear($evento);
                    break;
            }
        }
        return $eventosOrdenados;
    }

    private static function validarDisponibilidadEventos($eventos_id)
    {
        foreach ($eventos_id as $evento_id) {
            $evento = Evento::find($evento_id);
            if (!$evento || $evento->disponibles === "0") {
                $mensaje = "El evento $evento->nombre se encuentra actualmente agotado, porfavor seleccione otro evento.";

                header('Content-Type: application/json');
                echo json_encode(['respuesta' => false, 'titulo' => "Evento Agotado", "mensaje" => $mensaje]);
                exit;
            }
        }
    }
}
