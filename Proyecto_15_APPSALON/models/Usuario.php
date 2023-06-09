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

    public function hashContraseña()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken()
    {
        $this->token = uniqid();
    }

    public function validarNuevaCuenta()
    {
        if (!$this->camposVaciosCrearCuenta() && $this->contraseñaValida()) {
            $this->existeUsuario();
        }
        return self::$alertas;
    }

    public function validarLogin()
    {
        if (!$this->camposVaciosLogin()) {
            $this->validarCuentaLogin();
        }
        return self::$alertas;
    }

    public function validarRecuperarContraseña()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';

            return self::$alertas;
        }
        $usuario = Usuario::where('email', $this->email);
        if (empty($usuario) || !$usuario->confirmado) {
            self::$alertas['error'][] = 'Cuenta no registrada o no confirmada';
            return self::$alertas;
        }
        self::$alertas['exito'][] = "Se ha enviado un correo para reestabler la contraseña";

        return self::$alertas;
    }

    public function validarPassword()
    {
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatorio';
        } elseif (strlen($this->password) < 8) {
            self::$alertas['error'][] = 'El Password debe contener al menos 8 caracteres';
        }
        return self::$alertas;
    }

    private function camposVaciosCrearCuenta()
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

    private function camposVaciosLogin()
    {
        $flag = false;
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
            $flag = true;
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatorio';
            $flag = true;
        }
        return $flag;
    }

    private function validarCuentaLogin()
    {
        $auth = Usuario::where('email', $this->email);

        if (empty($auth)) {
            self::$alertas['error'][] = "Credenciales Incorrectas";
            return;
        }
        $contraseñaCorrecta = password_verify($this->password, $auth->password);

        if (!$contraseñaCorrecta) {
            self::$alertas['error'][] = "Credenciales Incorrectas";
            return;
        }
        if (!$auth->confirmado) {
            self::$alertas['error'][] = "Cuenta no confirmada";
        }
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
        $flag = true;
        $query = "SELECT * FROM " . self::$tabla . " WHERE email='$this->email' LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado->num_rows) {
            self::$alertas['error'][] = "Usuario ya registrado";
            $flag = false;
        }
    }
}
