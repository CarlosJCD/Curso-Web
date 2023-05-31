<?php

namespace App;

class Propiedad
{
    private static $db;

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

    public static function setDB($db)
    {
        self::$db = $db;
    }

    public static function all()
    {
        $query = "SELECT * FROM propiedades";
        return self::$db->query($query);
    }

    public static function ejecutarQuery($query)
    {
        $resultado = self::$db->query($query);

        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::cargarObjeto($registro);
        }

        $resultado->free();

        return $array;
    }

    private static function cargarObjeto($registro)
    {
        $objeto = new self;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    public function registrar()
    {
        $query = "INSERT INTO propiedades (Titulo, precio, imagen, descripcion, habitaciones, wc, estacionamientos, creado, vendedores_id) ";
        $query = $query . "VALUES  ('$this->titulo' , $this->precio, '$this->imagen','$this->descripcion', $this->habitaciones, $this->wc, $this->estacionamiento, '$this->fechaCreacion', $this->idVendedor);";
        return self::$db->query($query);
    }
}
