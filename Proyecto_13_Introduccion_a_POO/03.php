<?php include 'includes/header.php';

class Producto
{

    public static $imagen = "ejemplo.png";

    public function __construct(private string $nombre, private float $precio, private bool $disponible)
    {
    }
    public function toString()
    {
        echo "Nombre: $this->nombre , Precio: $this->precio , Disponible: $this->disponible <br>";
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getDisponible()
    {
        return $this->disponible;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public static function getImagen()
    {
        return self::$imagen;
    }
}

$producto = new Producto("Laptop", 150.00, false);

$producto->toString();

echo Producto::getImagen(), "<br>";

echo

include 'includes/footer.php';
