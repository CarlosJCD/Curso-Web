<?php

namespace Model;

class ActiveRecord
{
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];
    protected static $errores = [];


    public static function setDB($db)
    {
        self::$db = $db;
    }

    public static function getErrores()
    {
        return static::$errores;
    }

    public static function ejecutarQuery($query)
    {
        $resultado = self::$db->query($query);
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::cargarObjeto($registro);
        }

        $resultado->free();

        return $array;
    }

    private static function cargarObjeto($registro)
    {
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    public function obtenerAtributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna !== 'id') {
                $atributos[$columna] = $this->$columna;
            }
        }
        return $this->sanitizarAtributos($atributos);
    }

    public function sanitizarAtributos($atributos)
    {
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public function registrar()
    {
        $atributos = $this->obtenerAtributos();
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        self::$db->query($query);
    }

    public static function findById($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id;";
        $resultado = self::ejecutarQuery($query);
        return array_shift($resultado);
    }

    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        return self::ejecutarQuery($query);
    }

    public static function get($cantidad)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        return self::ejecutarQuery($query);
    }

    public function sincronizar($arreglo = [])
    {
        foreach ($arreglo as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    public function actualizar()
    {
        $atributos = $this->obtenerAtributos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";
        self::$db->query($query);
    }

    public function eliminar()
    {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        self::$db->query($query);

        if (isset($this->imagen)) {
            $this->borrarImagen();
        }
    }

    public function borrarImagen()
    {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }
}
