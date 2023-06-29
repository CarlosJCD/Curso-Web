<?php

namespace Controllers;

use Model\Ponente;
use Model\EventoHorario;


class APIEventos
{

    public static function index()
    {
        $dia_id = $_GET['dia_id'] ?? '';
        $categoria_id = $_GET['categoria_id'] ?? '';

        $dia_id = filter_var($dia_id, FILTER_VALIDATE_INT);
        $categoria_id = filter_var($categoria_id, FILTER_VALIDATE_INT);


        if (!$dia_id || !$categoria_id) {
            header('Content-Type: application/json');
            echo json_encode([]);
            return;
        }

        $eventos = EventoHorario::whereArray(['dia_id' => $dia_id, 'categoria_id' => $categoria_id]) ?? [];
        header('Content-Type: application/json');
        echo json_encode($eventos);
    }

    public static function ponente()
    {
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id || $id < 1) {
            echo json_encode([]);
            return;
        }

        $ponente = Ponente::find($id);
        header('Content-Type: application/json');
        echo json_encode($ponente, JSON_UNESCAPED_SLASHES);
    }
}
