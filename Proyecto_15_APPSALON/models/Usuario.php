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
            switch ($columna) {
                case "id":
                    $this->$columna = $args[$columna] ?? null;
                    break;
                case 'admin':
                case 'confirmado':
                    $this->$columna = $args[$columna] ?? '0';
                    break;
                default:
                    $this->$columna = $args[$columna] ?? "";
                    break;
            }
        }
    }

    public function validarNuevaCuenta()
    {
        if (!$this->camposVacios() && $this->contraseñaValida()) {
            $this->existeUsuario();
        }
        return self::$alertas;
    }

    public function hashContraseña()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken()
    {
        $this->token = uniqid();
    }

    private function camposVacios()
    {
        $flag = false;
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
            $flag = true;
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
            $flag = true;
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
            $flag = true;
        }
        return $flag;
    }

    private function contraseñaValida()
    {
        $flag = true;
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatorio';
            $flag = false;
        } elseif (strlen($this->password) < 8) {
            self::$alertas['error'][] = 'El Password debe contener al menos 8 caracteres';
            $flag = false;
        }
        return $flag;
    }

    private function existeUsuario()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email='$this->email' LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado->num_rows) {
            self::$alertas['error'][] = "Usuario ya registrado";
        }
    }
}
