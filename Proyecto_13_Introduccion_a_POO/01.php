<?php include 'includes/header.php';

class Producto
{

    public function __construct(public string $nombreP, public float $precioP, public bool $disponibleP)
    {
    }
}


$producto = new Producto("Laptop", 150.00, false);


echo '<pre>';
var_dump($producto);
echo '</pre>';

include 'includes/footer.php';
