<?php include 'includes/header.php';

class Producto
{

    public function __construct(public string $nombre, public float $precio, public bool $disponible)
    {
    }
    public function toString()
    {
        echo "Nombre: $this->nombre , Precio: $this->precio , Disponible: $this->disponible ";
    }
}


$producto = new Producto("Laptop", 150.00, false);
$producto->toString();

echo '<pre>';
var_dump($producto);
echo '</pre>';

include 'includes/footer.php';
