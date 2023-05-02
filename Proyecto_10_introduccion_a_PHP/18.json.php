<?php include 'includes/header.php';

/* 
Funciones que manejan JSON.

json_encode($array) -> Transforma un array a un string en formato JSON

json_decode($json) -> Convierte un string en formato JSON a un array asociativo
*/

$productos = [
    [
        'nombre' => 'Tablet', 
        'precio' => 200,
        'disponible' => true
    ],
    [
        'nombre' => 'Televisión 24"', 
        'precio' => 300,
        'disponible' => true
    ],
    [
        'nombre' => 'Monitor Curvo', 
        'precio' => 400,
        'disponible' => false
    ]
];

echo "<pre>";
//var_dump($productos);

$json = json_encode($productos, JSON_UNESCAPED_UNICODE);

$json_array = json_decode($json);

//var_dump($json);
var_dump($json_array);
echo "</pre>";


include 'includes/footer.php';