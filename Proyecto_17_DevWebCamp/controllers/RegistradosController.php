<?php

namespace Controllers;

use MVC\Router;
use Model\Registro;
use Classes\Paginacion;
use Model\Paquete;
use Model\Regalo;
use Model\Usuario;

class RegistradosController
{
    public static function index(Router $router)
    {
        validarAuth('/login');

        $paginacion = self::generarPaginacion($_GET['page'], 10);
        $registros = Registro::all();

        foreach ($registros as $registro) {
            $registro->usuario = Usuario::find($registro->usuario_id);
            $registro->paquete = Paquete::find($registro->paquete_id);
        }

        $router->render('admin/registrados/index', [
            'titulo' => 'Usuarios Registrados',
            'registros' => $registros,
            'paginacion' => $paginacion
        ]);
    }

    private static function generarPaginacion($numeroPagina, $registrosPorPagina)
    {
        $pagina_actual = filter_var($numeroPagina, FILTER_VALIDATE_INT);
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/registrados?page=1');
        }

        $total_registros = Registro::total();
        $paginacion = new Paginacion($pagina_actual, $registrosPorPagina, $total_registros);

        if ($pagina_actual > $paginacion->total_paginas()) {
            header('Location: /admin/registrados?page=1');
        }

        return $paginacion;
    }
}
