<?php

namespace App;

class Vendedor extends ActiveRecord
{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', "Nombre", "Apellido", "numTelefono"];

    public $id;
    public $Nombre;
    public $Apellido;
    public $numTelefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->Nombre = $args['Nombre'] ?? "";
        $this->Apellido =  $args['Apellido'] ?? "";
        $this->numTelefono = $args["numTelefono"] ?? "";
    }

    public function validar()
    {
        if (!$this->Nombre) {
            self::$errores[] = "El Nombre es Obligatorio";
        }

        if (!$this->Apellido) {
            self::$errores[] = "El Apellido es Obligatorio";
        }

        if (!$this->numTelefono) {
            self::$errores[] = "El Teléfono es Obligatorio";
        }

        if (!preg_match('/^[0-9]{10}$/', $this->numTelefono)) {
            self::$errores[] = "Teléfono no válido";
        }

        return self::$errores;
    }
}
