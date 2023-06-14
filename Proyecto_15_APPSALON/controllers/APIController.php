<?php

namespace Controllers;

use Model\Servicio;

class APIController
{
    public static function index()
    {
        $servicios = Servicio::all();
        header('Content-Type: application/json');
        echo json_encode($servicios, JSON_UNESCAPED_UNICODE);
    }
}
