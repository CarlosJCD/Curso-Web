<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = "usuarios";
    protected static $columnasDB = [
        'id', 'nombre', 'apellido',
        'email', 'telefono', 'admin', 'confirmado', 'token', 'password'
    ];
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;
    public $password;

    public function __construct($args = [])
    {
        foreach ($this->columnasDB as $columna) {
            if (in_array($columna, ['id', 'admin', 'confirmado'])) {
                $this->$columna = $args[$columna] ?? null;
            } else {
                $this->$columna = $args[$columna] ?? "";
            }
        }
    }
}
