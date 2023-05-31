<?php include 'includes/header.php';


class Producto
{

    public function __construct(private string $nombre, private float $precio, private bool $disponible)
    {
    }
    public function toString()
    {
        echo "Nombre: $this->nombre , Precio: $this->precio , Disponible: $this->disponible ";
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
}

$producto = new Producto("Laptop", 150.00, false);

$producto->toString();
$producto->setNombre("Smartphone");
echo "\n {$producto->getNombre()} ";

include 'includes/footer.php';
