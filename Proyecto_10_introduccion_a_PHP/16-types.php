<?php include 'includes/header.php';

function is_odd(int $number): bool{
    return ($number %2 === 1);
}

function main(): void{
    var_dump(is_odd(12));
}

main();

include 'includes/footer.php';