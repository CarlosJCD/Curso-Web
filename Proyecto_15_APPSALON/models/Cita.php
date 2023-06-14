<?php

namespace Model;

class Cita extends ActiveRecord
{
    protected static $tabla = 'citas';

    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioId'];

    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;

    public function __construct($args = [])
    {
        foreach (self::$columnasDB as $columna => $valor) {
            if ($columna === 'id') {
                $this->id = $valor ?? null;
            } else {
                $this->$columna = $valor ?? "";
            }
        }
    }
}
