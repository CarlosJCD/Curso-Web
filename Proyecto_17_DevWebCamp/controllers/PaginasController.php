<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Ponente;
use Model\Categoria;

class PaginasController
{
    public static function index(Router $router)
    {

        $eventosOrdenados = self::obtenerEventosOrdenados();

        $totalPonentes = Ponente::total();
        $totalConferencias = Evento::total();
        $total

        $router->render('/paginas/index', [
            'titulo' => 'Inicio',
            'eventos' => $eventosOrdenados
        ]);
    }

    private static function obtenerEventosOrdenados()
    {
        $eventos = Evento::ordenar('hora_id');
        $eventosOrdenados = [
            'conferencias_viernes' => [],
            'conferencias_sabado' => [],
            'workshops_viernes' => [],
            'workshops_sabado' => []
        ];

        foreach ($eventos as $evento) {

            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);

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
        return $eventosOrdenados;
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
        $eventosOrdenados = self::obtenerEventosOrdenados();

        $router->render('/paginas/conferencias', [
            'titulo' => 'Conferencias & Workshops',
            'eventos' => $eventosOrdenados
        ]);
    }
}
