<?php

namespace Model;

class Admin extends ActiveRecord
{

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
    }

    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = "Porfavor ingrese un correo electronico";
        }
        if (!$this->password) {
            self::$errores[] = "Porfavor ingrese una contraseña";
        }

        return self::$errores;
    }
}
