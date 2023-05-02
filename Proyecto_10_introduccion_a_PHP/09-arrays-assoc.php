<?php include 'includes/header.php';

//arreglos asociativos (Hashmaps/ Diccionarios)

$usuario = [
    'nombre' => 'Carlos',
    'edad' => '20 años',
    'Tech Stack' =>[ 'python', 'java', 'bash CLI', 'html', 'css'. 'JS DOM Scripting'],
    'PC'=>[
        'tipo' => 'laptop',
        'marca' => 'apple',
        'modelo' => 'macbook pro',
        'lanzamiento' => 'mid 2012',
        'OS' => 'MacOS 10.15 Catalina'
    ]
    ];

echo '<pre>';
var_dump($usuario);
echo '</pre>';

include 'includes/footer.php';