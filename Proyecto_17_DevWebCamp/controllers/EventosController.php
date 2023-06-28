<?php

namespace Controllers;

use Model\Categoria;
use MVC\Router;


class EventosController
{
    public static function index(Router $router)
    {
        $router->render('admin/eventos/index', [
            'titulo' => 'Conferencias y workshops'
        ]);
    }
    public static function crear(Router $router)
    {

        $categorias = Categoria::all();


        $router->render('admin/eventos/crear', [
            'titulo' => 'Registrar Evento',
            'alertas' => $alertas ?? [],
            'categorias' => $categorias
        ]);
    }
}
