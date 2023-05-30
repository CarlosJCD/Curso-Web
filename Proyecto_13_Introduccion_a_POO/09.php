<?php include 'includes/header.php';

$db = new mysqli('localhost', 'root', '', 'bienesraices');

$query = "SELECT titulo, imagen FROM propiedades";
$stmt = $db->prepare($query);

$stmt->execute();

$stmt->bind_result($titulo, $imagen);


while ($stmt->fetch()) {
    echo '<pre>';
    var_dump($imagen);
    echo '</pre>';
}



include 'includes/footer.php';
