<?php


namespace Controllers;

use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController
{
    public static function index(Router $router)
    {
        $ponentes = Ponente::all();

        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes / Conferencistas',
            'ponentes' => $ponentes
        ]);
    }

    public static function crear(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_FILES['imagen']['tmp_name'])) {
                $ruta_carpeta_imagenes = '../public/img/speakers';

                if (!is_dir($ruta_carpeta_imagenes)) {
                    mkdir($ruta_carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;
            }

            $ponente = new Ponente($_POST);

            $alertas = $ponente->validar();
        }

        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar Ponente',
            'alertas' => $alertas ?? [],
            'ponente' => $ponente ?? new Ponente
        ]);
    }
}
