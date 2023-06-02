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
}
