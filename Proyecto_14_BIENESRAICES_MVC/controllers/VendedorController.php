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
    }
    public static function eliminar(Router $router)
    {
    }
}
