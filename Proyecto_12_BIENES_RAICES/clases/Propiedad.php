<?php

namespace App;

class Propiedad
{

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $fechaCreacion;
    public $idVendedor;

    public function __construct($args = [])
    {
        $this->titulo = $args['titulo'] ?? "";
        $this->precio =  $args['precio'] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->fechaCreacion = $args["fechaCreacion"] ?? "";
        $this->idVendedor = $args["idVendedor"] ?? "";
    }
}
