<?php

namespace Controllers;

use MVC\Router;


class DashboardController
{
    public static function index(Router $router)
    {
        session_start();

        isAuth();

        $router->render('dashboard/index', [
            'titulo' => "Proyectos"
        ]);
    }

    public static function crearProyecto(Router $router)
    {
        session_start();

        isAuth();

        $router->render('dashboard/index', [
            'titulo' => "Crear proyecto"
        ]);
    }
    public static function perfil(Router $router)
    {
        session_start();

        isAuth();

        $router->render('dashboard/index', [
            'titulo' => "Perfil"
        ]);
    }
}
