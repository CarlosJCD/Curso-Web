<?php


namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];


    public function asociarFuncionGET($ruta, $nombreFuncionAsociada)
    {
        $this->rutasGET[$ruta] = $nombreFuncionAsociada;
    }

    private function obtenerFuncionAsociadaARuta(String $rutaActual, String $metodo)
    {
        switch ($metodo) {
            case "GET":
                return $this->rutasGET[$rutaActual] ?? null;
            case "POST":
                return $this->rutasGET[$rutaActual] ?? null;
            default:
                return null;
        }
    }

    public function comprobarRutas()
    {
        $rutaActual = $_SERVER["PATH_INFO"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];

        $funcionAsociada = $this->obtenerFuncionAsociadaARuta($rutaActual, $metodo);


        if ($funcionAsociada) {
            call_user_func($funcionAsociada, $this);
        } else {
            echo "Pagina no encontrada";
        }
    }
}
