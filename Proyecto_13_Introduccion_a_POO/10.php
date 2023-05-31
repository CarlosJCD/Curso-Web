<?php include 'includes/header.php';

$db = new PDO('mysql:host=localhost; dbname=bienesraices', 'root', '');

$query = "SELECT titulo, imagen from propiedades";

$stmt = $db->prepare($query);

$stmt->execute();

$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultado as $propiedad) :
    echo $propiedad['titulo'];
    echo "<br>";
    echo $propiedad['imagen'];
    echo "<br>";
endforeach;


include 'includes/footer.php';
