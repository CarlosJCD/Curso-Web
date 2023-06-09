<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;
use Model\EntradaBlog;

class PropiedadController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $entradasBlog = EntradaBlog::all();
        $tipo = $_GET['tipo'] ?? false;
        $router->display("propiedades/admin", [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            "entradasBlog" => $entradasBlog,
            "tipo" => $tipo
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $propiedad = new Propiedad($_POST["propiedad"]);

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if (($_FILES['propiedad']['tmp_name']['imagen'])) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            $errores = $propiedad->validar();
            if (empty($errores)) {

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                $image->save(CARPETA_IMAGENES . $nombreImagen);

                $propiedad->registrar();
            }
        }


        $router->display("propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar("/admin");

        $propiedad = Propiedad::findById($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propiedad->sincronizar($_POST['propiedad']);
            $errores = $propiedad->validar();

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if (empty($errores)) {
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                    $propiedad->setImagen($nombreImagen);
                }
                $propiedad->actualizar();
            }
        }

        $router->display('propiedades/actualizar', [
            'propiedad' => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['tipo'];
            if (validarTipoContenido($tipo)) {
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);

                $propiedad = Propiedad::findById($id);
                $resultado = $propiedad->eliminar();
                if ($resultado) {
                    header("Location: /admin?tipo=propiedad");
                }
            }
        }
    }
}
