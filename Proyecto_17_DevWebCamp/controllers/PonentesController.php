<?php


namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController
{
    public static function index(Router $router)
    {
        validarAdmin("/login'");

        $paginacion = self::generarPaginacion($_GET['page'], 10);

        $ponentes = Ponente::paginar($paginacion->registros_por_pagina, $paginacion->offset());

        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes / Conferencistas',
            'ponentes' => $ponentes,
            'paginacion' => $paginacion
        ]);
    }

    private static function generarPaginacion($numeroPagina, $registrosPorPagina)
    {
        $pagina_actual = filter_var($numeroPagina, FILTER_VALIDATE_INT);
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/ponentes?page=1');
        }

        $total_registros = Ponente::total();
        $paginacion = new Paginacion($pagina_actual, $registrosPorPagina, $total_registros);

        if ($pagina_actual > $paginacion->total_paginas()) {
            header('Location: /admin/ponentes?page=1');
        }

        return $paginacion;
    }

    public static function crear(Router $router)
    {
        validarAdmin("/login");

        $ponente = new Ponente;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            validarAdmin("/login");


            if (!empty($_FILES['imagen']['tmp_name'])) {
                $ruta_carpeta_imagenes = '../public/img/speakers';

                $nombre_imagen = self::generarNombreImagen($ruta_carpeta_imagenes);

                $imagen_png = self::generarImagenPng($ruta_carpeta_imagenes);
            }


            $ponente = new Ponente($_POST);


            $alertas = $ponente->validar();
            if (empty($alertas)) {

                $imagen_png->save($ruta_carpeta_imagenes . '/' . $nombre_imagen . ".png");
                $resultado = $ponente->guardar();

                if ($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar Ponente',
            'alertas' => $alertas ?? [],
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    private static function generarImagenPng()
    {

        $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 80);

        return $imagen_png;
    }

    private static function generarImagenWebP($ruta_carpeta_imagenes)
    {
        $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 80);
        return $imagen_webp;
    }

    private static function generarNombreImagen($ruta_carpeta_imagenes)
    {
        if (!is_dir($ruta_carpeta_imagenes)) {
            mkdir($ruta_carpeta_imagenes, 0755, true);
        }

        $nombre_imagen = md5(uniqid(rand(), true));

        $_POST['imagen'] = $nombre_imagen;

        return $nombre_imagen;
    }

    public static function editar(Router $router)
    {
        validarAdmin("/login");

        $id = validar_id($_GET['id'], "/admin/ponentes");

        $ponente = self::validarExistenciaPonente($id);

        $ponente->imagen_actual = $ponente->imagen;

        $redes = json_decode($ponente->redes);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            validarAdmin("/login");

            if (!empty($_FILES['imagen']['tmp_name'])) {

                $carpeta_imagenes = '../public/img/speakers';

                $nombre_imagen = self::generarNombreImagen($carpeta_imagenes);

                $imagen_png = self::generarImagenPng();
            } else {
                $_POST['imagen'] = $ponente->imagen_actual;
            }

            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);

            $alertas = $ponente->validar();

            if (empty($alertas)) {

                if (isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                }
                $resultado = $ponente->guardar();
                if ($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }


        $router->render('admin/ponentes/editar', [
            'titulo' => 'Editar Ponente',
            'alertas' => $alertas ?? [],
            'ponente' => $ponente,
            'redes' => $redes
        ]);
    }

    public static function validarExistenciaPonente($id)
    {
        $ponente = Ponente::find($id);

        if (!$ponente) {
            header('Location: /admin/ponentes');
        }

        return $ponente;
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            validarAdmin("/login");

            $id = $_POST['id'];
            $ponente = Ponente::find($id);
            if (!isset($ponente)) {
                header('Location: /admin/ponentes');
            }
            $resultado = $ponente->eliminar();
            if ($resultado) {
                header('Location: /admin/ponentes');
            }
        }
    }
}
