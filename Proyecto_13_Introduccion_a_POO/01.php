<?php include 'includes/header.php';

class Producto
{
    public $nombre;
    public $precio;
    public $disponible;
}


$producto = new Producto();
$producto->nombre = "Computadora";
$producto->precio = 100.00;
$producto->disponible = true;


echo '<pre>';
var_dump($producto);
echo '</pre>';

include 'includes/footer.php';
