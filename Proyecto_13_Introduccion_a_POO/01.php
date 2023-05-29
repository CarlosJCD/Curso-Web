<?php include 'includes/header.php';

class Producto
{
    public $nombre;
    public $precio;
    public $disponible;

    public function __construct(string $nombreP, float $precioP, bool $disponibleP)
    {
        $this->nombre = $nombreP;
        $this->precio = $precioP;
        $this->disponible = $disponibleP;
    }
}


$producto = new Producto("Laptop", 150.00, false);


echo '<pre>';
var_dump($producto);
echo '</pre>';

include 'includes/footer.php';
