<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;

class PropiedadController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $router->display("propiedades/admin", [
            'propiedades' => $propiedades
        ]);
    }
    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $router->display("propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores
        ]);
    }
    public static function actualizar()
    {
        echo "actualizar";
    }
}
