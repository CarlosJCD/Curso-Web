<?php include 'includes/header.php';

// estructuras de control condicionales: if, else, switch

$variable;

if(isset($variable)){
    echo 'Asginado';
} else{
    echo 'no asignado';
}



switch (1E10 <=> 2.5E20) {
    case '0':
        echo ' Iguales!!';
        break;
    
    case 1:
        echo ' Mayor que!!';
        break;
    
    case -1:
        echo ' Menor que!!';
        break;
    
    default:
        echo " No debo de aparecer!!!";
        break;
}


include 'includes/footer.php';