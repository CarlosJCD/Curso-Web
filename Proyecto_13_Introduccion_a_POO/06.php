<?php include 'includes/header.php';

interface ITransporte
{
    public function getInfo(): string;
    public function getRuedas(): int;
}
class Transporte implements ITransporte
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


include 'includes/footer.php';
