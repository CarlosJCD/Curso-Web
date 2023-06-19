<?php

namespace Controllers;

use Model\Proyecto;
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
            //debuguear($_POST);
            $proyecto = new Proyecto($_POST);
            $alertas = $proyecto->validarProyecto();
            if (empty($alertas)) {
            }
        }

        $router->render('dashboard/crearProyecto', [
            'titulo' => "Crear proyecto",
            'errores' => $alertas['error'] ?? ''
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
