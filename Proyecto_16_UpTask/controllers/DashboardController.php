<?php

namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
use MVC\Router;


class DashboardController
{
    public static function index(Router $router)
    {
        session_start();
        isAuth();

        $proyectos = Proyecto::belongsTo("propietarioId", $_SESSION['id']);

        $router->render('dashboard/index', [
            'titulo' => "Proyectos",
            'proyectos' => $proyectos
        ]);
    }

    public static function crearProyecto(Router $router)
    {
        session_start();
        isAuth();

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST);
            $alertas = $proyecto->validarProyecto();

            if (empty($alertas)) {
                $proyecto->url = md5(uniqid());

                $proyecto->propietarioId = $_SESSION['id'];

                $proyecto->guardar();

                header("Location: /proyecto?url=" . $proyecto->url);
            }
        }

        $router->render('dashboard/crearProyecto', [
            'titulo' => "Crear proyecto",
            'errores' => $alertas['error'] ?? ''
        ]);
    }

    public static function proyecto(Router $router)
    {
        $proyecto = self::validarPropietarioProyecto();


        $router->render('dashboard/proyecto', [
            'titulo' => $proyecto->proyecto
        ]);
    }

    public static function perfil(Router $router)
    {
        session_start();
        isAuth();

        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarPerfil($_SESSION['email']);
            if (empty($alertas)) {
                $usuario->guardar();

                Usuario::setAlerta('exito', "Perfil actualizado correctamente");

                $_SESSION['nombre'] = $usuario->nombre;
                $_SESSION['email'] = $usuario->email;
                $alertas = Usuario::getAlertas();
            }
        }

        $router->render('dashboard/perfil', [
            'titulo' => "Perfil",
            'errores' => $alertas['error'] ?? [],
            'exitos' => $alertas['exito'] ?? []
        ]);
    }

    public static function cambiar_password(Router $router)
    {
        session_start();
        isAuth();
        $router->render('dashboard/cambiar_password', [
            'titulo' => 'Cambiar Password'
        ]);
    }

    private static function validarPropietarioProyecto()
    {
        session_start();
        isAuth();

        $url = s($_GET['url']);
        if (!$url) {
            header("Location: /dashboard");
        }

        $proyecto = Proyecto::where('url', $url);
        if (!$proyecto || ($proyecto->propietarioId != $_SESSION['id'])) {
            header("Location: /dashboard");
        }
        return $proyecto;
    }
}
