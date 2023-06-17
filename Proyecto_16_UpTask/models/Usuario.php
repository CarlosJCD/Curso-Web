<?php

namespace Model;

#[\AllowDynamicProperties]
class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    public function validarNuevaCuenta($validacionPassword)
    {
        if (!$this->camposValidosCuentaNueva($validacionPassword)) {
            $this->validarSiYaExiste();
        }
        return self::$alertas;
    }

    public function crearCuenta()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        $this->token = uniqid();

        return $this->guardar();
    }

    public function validarCambiarContraseña()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
            return self::$alertas;
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no valido';
            return self::$alertas;
        }
        $usuarioExistente = Usuario::where('email', $this->email);
        if (!$usuarioExistente || $usuarioExistente->confirmado != '1') {
            self::$alertas['error'][] = 'Email no registrado!';
        }
        return self::$alertas;
    }


    private function camposValidosCuentaNueva($validacionPassword): bool
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Usuario es Obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password no puede ir vacio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        }
        if ($this->password !== $validacionPassword) {
            self::$alertas['error'][] = 'Los password son diferentes';
        }

        return !empty(self::$alertas);
    }

    private function validarSiYaExiste()
    {
        $usuarioExistente = self::where('email', $this->email);
        if ($usuarioExistente) {
            self::$alertas['error'][] = 'El correo electronico ya ha sido registrado en otra cuenta';
        }
    }
}
