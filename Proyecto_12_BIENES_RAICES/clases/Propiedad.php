<?php

namespace App;

class Propiedad extends ActiveRecord
{
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'fechaCreacion', 'idVendedor'];

    protected static $tabla = 'propiedades';
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $estacionamiento;
    public $wc;
    public $fechaCreacion;
    public $idVendedor;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? "";
        $this->precio =  $args['precio'] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->habitaciones = $args["estacionamiento"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->fechaCreacion = $args["fechaCreacion"] ?? "";
        $this->idVendedor = $args["idVendedor"] ?? "";
    }
}
