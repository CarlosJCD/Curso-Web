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
        $algunCampoVacio = !$this->email || !$this->password;
        if ($algunCampoVacio) {
            if (!$this->email) {
                self::$errores[] = "Porfavor ingrese un correo electronico";
            }

            if (!$this->password) {
                echo $this->password;
                self::$errores[] = "Porfavor ingrese una contraseña";
            }
        } else {
            $resultado = $this->existeUsuario();
            if ($resultado) {
                $this->validarContraseña($resultado->fetch_assoc());
            }
        }
        return self::$errores;
    }

    public function existeUsuario()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email='$this->email' LIMIT 1";

        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = "Credenciales invalidas";
            return;
        }
        return $resultado;
    }

    public function validarContraseña($usuario)
    {
        $autenticacion = password_verify($this->password, $usuario["password"]);

        if (!$autenticacion) {
            self::$errores[] = "Credenciales invalidas";
        }
    }
}
