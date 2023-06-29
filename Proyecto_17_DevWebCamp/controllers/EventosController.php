<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Categoria;
use Classes\Paginacion;

class EventosController
{
    public static function index(Router $router)
    {
        $paginacion = self::generarPaginacion($_GET['page'], 2);

        $eventos = Evento::paginar($paginacion->registros_por_pagina, $paginacion->offset());

        $router->render('admin/eventos/index', [
            'titulo' => 'Conferencias y workshops',
            'paginacion' => $paginacion,
            'eventos' => $eventos
        ]);
    }

    private static function generarPaginacion($numeroPagina, $registrosPorPagina)
    {
        $pagina_actual = filter_var($numeroPagina, FILTER_VALIDATE_INT);
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/eventos?page=1');
            return;
        }

        $total_registros = Evento::total();
        $paginacion = new Paginacion($pagina_actual, $registrosPorPagina, $total_registros);

        if ($pagina_actual > $paginacion->total_paginas()) {
            header('Location: /admin/eventos?page=1');
            return;
        }

        return $paginacion;
    }

    public static function crear(Router $router)
    {

        $categorias = Categoria::all();
        $dias = Dia::all();
        $horas = Hora::all();
        $evento = new Evento();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evento->sincronizar($_POST);

            $alertas = $evento->validar();

            if (empty($alertas)) {
                $resultado = $evento->guardar();

                if ($resultado) {
                    header('Location: /admin/eventos');
                }
            }
        }

        $router->render('admin/eventos/crear', [
            'titulo' => 'Registrar Evento',
            'alertas' => $alertas ?? [],
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
        ]);
    }
}
