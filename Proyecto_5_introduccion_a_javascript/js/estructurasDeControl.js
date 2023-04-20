"use-strict";
// Estructuras de control

// if - else

let edad = 18;

if (edad >= 18)
    console.log("Mayor de edad!!!");
else
    console.log("Menor de edad!!!");


//switch

let precio = 350;

switch (precio) {
    case precio <= 200:
        console.log("Muy Barato");
        break;
    case precio === 350:
        console.log("Precio Normal");
        break;
    case 500:
        console.log("Muy Caro")
        break;
    default:
        console.log("Precio Caro");
        break;
}

