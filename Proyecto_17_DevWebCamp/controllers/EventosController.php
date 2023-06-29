<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Categoria;
use Classes\Paginacion;
use Model\Ponente;

class EventosController
{
    public static function index(Router $router)
    {
        validarAdmin('/login');

        $paginacion = self::generarPaginacion($_GET['page'], 10);

        $eventos = Evento::paginar($paginacion->registros_por_pagina, $paginacion->offset());

        foreach ($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
        }

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
        validarAdmin('/login');

        $categorias = Categoria::all();
        $dias = Dia::all();
        $horas = Hora::all();
        $evento = new Evento();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            validarAdmin("/login");

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

    public static function editar(Router $router)
    {
        $idEvento = validar_id($_GET['id'], '/admin/eventos');
        $evento = self::validarExistenciaEvento($idEvento);

        $categorias = Categoria::all();
        $dias = Dia::all();
        $horas = Hora::all();

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

        $router->render('admin/eventos/editar', [
            'titulo' => 'Editar Evento',
            'alertas' => $alertas ?? [],
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
        ]);
    }

    private static function validarExistenciaEvento($idEvento)
    {
        $evento = Evento::find($idEvento);

        if (!$evento) {
            header("Location: /admin/eventos");
        }

        return $evento;
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            validarAdmin('/admin/eventos');

            $id = $_POST['id'];
            $evento = self::validarExistenciaEvento($id);

            $resultado = $evento->eliminar();
            if ($resultado) {
                header('Location: /admin/eventos');
            }
        }
    }
}
