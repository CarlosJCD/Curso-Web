<?php

namespace Controllers;

use MVC\Router;

class RegistroController
{
    public static function crear(Router $router)
    {
        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);
    }
}
