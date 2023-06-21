<?php

namespace Controllers;

class TareaController
{
    public static function index()
    {
    }
    public static function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $respuesta = [
                'proyectoUrl' => $_POST['proyectoUrl']
            ];

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
