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
        $rutaActual = $_SERVER["SCRIPT_NAME"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];

        $nombreFuncionAsociada = $this->obtenerFuncionAsociadaARuta($rutaActual, $metodo);


        if ($nombreFuncionAsociada) {
            call_user_func($nombreFuncionAsociada, $this);
        } else {
            echo "Pagina no encontrada";
        }
    }
}
