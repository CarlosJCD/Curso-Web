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
            $array = [
                'respuesta' => true,
                'nombre' => $_POST['nombre']
            ];

            header('Content-Type: application/json');
            echo json_encode($array, JSON_UNESCAPED_UNICODE);
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
