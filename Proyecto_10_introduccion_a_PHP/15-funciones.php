<?php include 'includes/header.php';

function print_evens(array $numbers){
    foreach ($numbers as $number) {
        if($number % 2 === 0){
            echo $number . '<br/>';
        }
    }
}

function main(){
    $numeros = [10, 23, 324, 32421, 923, 1234, 380123];
    print_evens($numeros);
}

main();
include 'includes/footer.php';