<?php include 'includes/header.php';

interface TransporteInterfaz
{
    public function getInfo(): string;
    public function getRuedas(): int;
}

class Transporte implements TransporteInterfaz
{
    public function __construct(protected int $ruedas, protected int $capacidad)
    {
    }

    public function getInfo(): string
    {
        return "El transporte tiene " . $this->ruedas . " ruedas y una capacidad de " . $this->capacidad . " personas ";
    }

    public function getRuedas(): int
    {
        return $this->ruedas;
    }
}

class Automovil extends Transporte implements TransporteInterfaz
{
    public function __construct(protected int $ruedas, protected int $capacidad, protected string $color)
    {
    }

    public function getInfo(): string
    {
        return "El transporte AUTO tiene " . $this->ruedas . " ruedas y una capacidad de " . $this->capacidad . " personas y tiene el color" . $this->color;
    }

    public function getColor(): string
    {
        return "El color es " . $this->color;
    }
}

echo "<pre>";

var_dump($transporte = new Transporte(8, 20));
var_dump($auto = new Automovil(4, 4, 'Rojo'));

echo $transporte->getInfo();
echo "<br>";

echo $auto->getInfo();
echo "<br>";

echo $auto->getColor();

echo "</pre>";


include 'includes/footer.php';
