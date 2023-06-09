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
        foreach (self::$columnasDB as $columna) {
            if (in_array($columna, ['id', 'admin', 'confirmado'])) {
                $this->$columna = $args[$columna] ?? null;
            } else {
                $this->$columna = $args[$columna] ?? "";
            }
        }
    }
    public function validarNuevaCuenta()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        }



        return self::$alertas;
    }
}
