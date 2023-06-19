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
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }

        $router->render('dashboard/crearProyecto', [
            'titulo' => "Crear proyecto",
            'alertas' => $alertas
        ]);
    }
    public static function perfil(Router $router)
    {
        session_start();

        isAuth();

        $router->render('dashboard/perfil', [
            'titulo' => "Perfil"
        ]);
    }
}
