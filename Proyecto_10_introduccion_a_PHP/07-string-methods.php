<?php include 'includes/header.php';

// funciones para strings
$lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";

//strlen 
echo(strlen($lorem));

// trim - eliminar espacios en blanco

echo (trim($lorem));

// strtoupper

echo (strtoupper($lorem));

// strtolower
echo(strtolower($lorem));

// str_reoplace

echo str_replace("HOLAAAA", "Lorem", $lorem);

// strpos -- validar la existencia de un substring

echo strpos($lorem,'dolor');


include 'includes/footer.php';