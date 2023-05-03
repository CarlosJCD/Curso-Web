<?php include 'includes/header.php';

// arreglos indexados (arrays tipicos que se encuentran en JS, C, Java, python, etc.)

$array_indexado = ['c', 'd', 'f']; // Es lo mismo a : $array_indexado = array('c', 'd', 'f');

// METODOS DE ARRAYS INDEXADOS:
/*
array_push($array,"a") --> Añade el string 'a' al final del array '$array'

array_unshift($array,"b") --> Añade el string 'b' al principio del array '$array'
*/

// Pretty print array indexado:
echo '<pre>';
var_dump($array_indexado);
echo '</pre>';

/*
array(3) {
  [0]=>
  string(1) "c"
  [1]=>
  string(1) "d"
  [2]=>
  string(1) "f"
}
*/

include 'includes/footer.php';