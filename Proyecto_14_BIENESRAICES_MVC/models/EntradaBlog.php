<?php

namespace Model;

use Model\ActiveRecord;

class EntradaBlog extends ActiveRecord
{
    protected static $columnasDB = ['id', "titulo", "imagen", "sinopsis", "fechaCreacion", "autor", "resumen"];

    protected static $tabla = 'entradasBlog';

    public $id;
    public $titulo;
    public $imagen;
    public $sinopsis;
    public $fechaCreacion;
    public $autor;
    public $resumen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? "";
        $this->sinopsis = $args['sinopsis'] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->autor = $args["autor"] ?? "";
        $this->resumen = $args["resumen"] ?? "";
        $this->fechaCreacion = date('Y/m/d');
    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = "Titulo obligatorio";
        }
        if (!$this->autor) {
            self::$errores[] = "Autor obligatorio";
        }
        if (!$this->sinopsis) {
            self::$errores[] = "Sinopsis obligatoria";
        }
        if (strlen($this->sinopsis) < 25) {
            self::$errores[] = "La sinopsis debe de tener una longitud mayor a 25 caracteres";
        }

        if (strlen($this->sinopsis) > 150) {
            self::$errores[] = "La sinopsis debe tener una longitud menor a 150 caracteres";
        }
        if (!$this->resumen) {
            self::$errores[] = "El cuerpo (texto) de la entrada no debe de estar vacio";
        }
        if (strlen($this->resumen) < 75) {
            self::$errores[] = "El cuerpo (texto) de la entrada debe de ser mayor a 75 caracteres";
        }

        if (!$this->id) {
            $this->validarImagen();
        }
        return self::$errores;
    }

    public function validarImagen()
    {
        if (!$this->imagen) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }
    }

    public function setImagen($imagen)
    {
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen()
    {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES_ENTRADAS . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES_ENTRADAS . $this->imagen);
        }
    }

    // Funcion original extraida de: https://stackoverflow.com/a/14467470
    // Adaptada para el contexto de las entradas de blog
    public function procesarParrafos()
    {
        if ($this->resumen != "") {
            $parrafos = '';

            foreach (explode("\n", $this->resumen) as $parrafo) {
                if (trim($parrafo)) {
                    $parrafos .= '<p>' . $parrafo . '</p>';
                }
            }

            return $parrafos;
        }
    }
}
