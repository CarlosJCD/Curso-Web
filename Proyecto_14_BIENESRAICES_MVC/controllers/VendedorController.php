<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController
{

    public static function crear(Router $router)
    {
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vendedor = new Vendedor($_POST["vendedor"]);
            $errores = $vendedor->validar();
            if (empty($errores)) {
                $vendedor->registrar();
            }
        }
        $router->display("vendedores/crear", [
            "vendedor" => $vendedor,
            "errores" => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar("/admin");

        $vendedor = vendedor::findById($id);
        $errores = vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vendedor->sincronizar($_POST['vendedor']);
            $errores = $vendedor->validar();

            if (empty($errores)) {
                $vendedor->actualizar();
            }
        }

        $router->display('vendedores/actualizar', [
            'vendedor' => $vendedor,
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

                $vendedor = Vendedor::findById($id);
                $vendedor->eliminar();
            }
        }
    }
}
