<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController
{
    public static function index()
    {
        $servicios = Servicio::all();
        header('Content-Type: application/json');
        echo json_encode($servicios, JSON_UNESCAPED_UNICODE);

    }

    public static function guardar()
    {
        $cita =  new Cita($_POST);
        $resultado = $cita->guardar();

        $idCita = $resultado['id'];
        $idServicios = explode(",", $_POST['servicios']);

        foreach ($idServicios as $idServicio) {
            $args = [
                'citaId' => $idCita,
                "servicioId" => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        header('Content-Type: application/json');
        echo json_encode(['resultado' => $resultado], JSON_UNESCAPED_UNICODE);

    }
}
