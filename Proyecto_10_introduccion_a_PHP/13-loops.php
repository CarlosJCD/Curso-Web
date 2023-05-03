<?php include 'includes/header.php';

/*

loops en PHP:

for
While
do While
*/

// foreach
$numeros = [1, 2 , 3, 4, 5, 6];

foreach($numeros as $numero){
    if($numero % 2 === 0){
        echo $numero . '<br />'; 
    }
}

include 'includes/footer.php';