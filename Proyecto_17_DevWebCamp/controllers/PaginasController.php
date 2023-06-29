<?php

namespace Controllers;

use Model\Evento;
use MVC\Router;

class PaginasController
{
    public static function index(Router $router)
    {
        $router->render('/paginas/index', [
            'titulo' => 'Inicio'
        ]);
    }

    public static function evento(Router $router)
    {
        $router->render('/paginas/devwebcamp', [
            'titulo' => 'Sobre DevWebCamp'
        ]);
    }

    public static function paquetes(Router $router)
    {
        $router->render('/paginas/paquetes', [
            'titulo' => 'Paquetes DevWebCamp'
        ]);
    }

    public static function conferencias(Router $router)
    {
        $eventos = Evento::ordenar('hora_id');

        $eventosOrdenados = [
            'conferencias_viernes' => [],
            'conferencias_sabado' => [],
            'workshops_viernes' => [],
            'workshops_sabado' => []
        ];
        foreach ($eventos as $evento) {
            switch (true) {
                case $evento->dia_id === '1' && $evento->categoria_id === '1':
                    $eventosOrdenados['conferencias_viernes'][] = $evento;
                    break;
                case $evento->dia_id === '1' && $evento->categoria_id === '2':
                    $eventosOrdenados['workshops_viernes'][] = $evento;
                    break;
                case $evento->dia_id === '2' && $evento->categoria_id === '1':
                    $eventosOrdenados['conferencias_sabado'][] = $evento;
                    break;
                case $evento->dia_id === '2' && $evento->categoria_id === '2':
                    $eventosOrdenados['workshops_sabado'][] = $evento;
                    break;
                default:
                    debuguear($evento);
                    break;
            }
        }
        debuguear($eventosOrdenados);

        $router->render('/paginas/conferencias', [
            'titulo' => 'Conferencias & Workshops'
        ]);
    }
}
