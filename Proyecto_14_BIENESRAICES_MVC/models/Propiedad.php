<?php

namespace Model;

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
        $this->estacionamiento = $args["estacionamiento"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->fechaCreacion = date('Y/m/d');
        $this->idVendedor = $args["idVendedor"] ?? "";
    }
    public function validar()
    {

        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if (!$this->precio) {
            self::$errores[] = 'El Precio es Obligatorio';
        }

        if (strlen($this->descripcion) < 50) {
            self::$errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
        }

        if (!$this->habitaciones) {
            self::$errores[] = 'El Número de habitaciones es obligatorio';
        }

        if (!$this->wc) {
            self::$errores[] = 'El Número de Baños es obligatorio';
        }

        if (!$this->estacionamiento) {
            self::$errores[] = 'El Número de lugares de Estacionamiento es obligatorio';
        }

        if (!$this->idVendedor) {
            self::$errores[] = 'Elige un vendedor';
        }

        if (!$this->id) {
            $this->validarImagen();
        }
        return self::$errores;
    }

    public function validarImagen()
    {
        if (!$this->imagen) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }
    }

    public function setImagen($imagen)
    {
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen()
    {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }
}
