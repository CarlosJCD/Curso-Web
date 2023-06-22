<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController
{
    public static function index()
    {

        session_start();
        $proyectoUrl = $_GET['url'];
        $proyecto = Proyecto::where('url', $proyectoUrl);
        if (!$proyectoUrl || !$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
            header("Location: /dashboard");
            return;
        }
        $tareas = Tarea::belongsTo('proyectoId', $proyecto->id);

        header('Content-Type: application/json');
        echo json_encode(['tareas' => $tareas]);
    }

    public static function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            session_start();

            $proyecto = Proyecto::where('url', $_POST['proyectoUrl']);

            $noSePuedeGuardar = !$proyecto || ($proyecto->propietarioId) !== $_SESSION['id'];

            if (!$noSePuedeGuardar) {
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

                if (!$resultado) {
                    $respuesta = [
                        'tipo' => 'exito',
                        'mensaje' => 'Tarea agregada correctamente',
                        'id' => $resultado['id'],
                        'proyectoId' => $proyecto->id
                    ];
                }
            }
            header('Content-Type: application/json');
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }

    public static function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            session_start();
            $proyecto = Proyecto::where('url', $_POST['proyectoUrl']);

            $respuesta = [
                'tipo' => 'error',
                'mensaje' => "Hubo un error al agregar la tarea"
            ];

            $noSePuedeActualizar = !$proyecto || ($proyecto->propietarioId) !== $_SESSION['id'];

            if (!$noSePuedeActualizar) {
                $args = [
                    'nombre' => $_POST['nombre'],
                    'id' => $_POST['id'],
                    'estado' => $_POST['estado'],
                    'proyectoId' => $proyecto->id
                ];

                $tarea = new Tarea($args);

                $resultado = $tarea->guardar();
                if ($resultado) {
                    $respuesta = [
                        'tipo' => 'exito',
                        'id' => $tarea->id,
                        'mensaje' => 'Tarea actualizada correctamente',
                        'proyectoId' => $proyecto->id
                    ];
                }
            }

            header('Content-Type: application/json');
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        }
    }
}
