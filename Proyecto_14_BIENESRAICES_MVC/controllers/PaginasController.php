<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\EntradaBlog;

class PaginasController
{
    public static function index(Router $router)
    {
        $router->display('paginas/index', [
            'inicio' => true,
            'propiedades' => Propiedad::get(3)
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->display('paginas/nosotros');
    }
    public static function propiedades(Router $router)
    {
        $router->display('paginas/propiedades', [
            'propiedades' => Propiedad::all()
        ]);
    }
    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar("/");
        $router->display('paginas/propiedad', [
            'propiedad' => Propiedad::findById($id)
        ]);
    }
    public static function blog(Router $router)
    {
        $entradasBlog = EntradaBlog::all();
        $router->display('paginas/blog', [
            "entradasBlog" => $entradasBlog
        ]);
    }
    public static function entrada(Router $router)
    {
        $id = validarORedireccionar("/blog");
        $entradaBlog = EntradaBlog::findById($id);
        $router->display('paginas/entrada', [
            'entradaBlog' => $entradaBlog
        ]);
    }
    public static function contacto(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo '<pre>';
            var_dump($_POST);
            echo '</pre>';
            exit;
        }

        $router->display('paginas/contacto');
    }
}
