<?php

namespace Controllers;

use Model\EntradaBlog;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;


class EntradaBlogController
{
    public static function crear(Router $router)
    {
        $entradaBlog = new EntradaBlog();
        $errores = EntradaBlog::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $entradaBlog = new EntradaBlog($_POST['entrada']);

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if (($_FILES['entrada']['tmp_name']['imagen'])) {
                $image = Image::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800, 600);
                $entradaBlog->setImagen($nombreImagen);
            }

            $errores = $entradaBlog->validar();
            if (empty($errores)) {
                if (!is_dir(CARPETA_IMAGENES_ENTRADAS)) {
                    mkdir(CARPETA_IMAGENES_ENTRADAS);
                }
                $image->save(CARPETA_IMAGENES_ENTRADAS . $nombreImagen);
                $entradaBlog->registrar();
            }
        }

        $router->display('entradasBlog/crear', [
            "entradaBlog" => $entradaBlog,
            "errores" => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar("/admin");

        $entradaBlog = EntradaBlog::findById($id);
        $errores = EntradaBlog::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $entradaBlog->sincronizar($_POST['entrada']);
            $errores = $entradaBlog->validar();

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if (empty($errores)) {
                if ($_FILES['entrada']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800, 600);
                    $image->save(CARPETA_IMAGENES_ENTRADAS . $nombreImagen);
                    $entradaBlog->setImagen($nombreImagen);
                }
                $entradaBlog->actualizar();
            }
        }

        $router->display('entradasBlog/actualizar', [
            'entradaBlog' => $entradaBlog,
            "errores" => $errores
        ]);
    }

    public static function eliminar(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['tipo'];
            if (validarTipoContenido($tipo)) {
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);

                $propiedad = EntradaBlog::findById($id);
                $propiedad->eliminar();
            }
        }
    }
}
