<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController
{
    public static function index()
    {
    }
    public static function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            session_start();
            $proyecto = Proyecto::where('url', $_POST['proyectoUrl']);
            if (!$proyecto || ($proyecto->propietarioId) !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => "Hubo un error al agregar la tarea"
                ];
            } else {
                $args = [
                    'nombre' => $_POST['nombre'],
                    'proyectoId' => $proyecto->id
                ];

                $tarea = new Tarea($args);

                $resultado = $tarea->guardar();

                $respuesta = [
                    'tipo' => 'exito',
                    'mensaje' => 'Tarea agregada correctamente',
                    'id' => $resultado['id'],
                ];
            }
            header('Content-Type: application/json');
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }
    public static function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        }
    }
    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        }
    }
}
