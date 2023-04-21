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
    case 200:
        console.log("Muy Barato");
        break;
    case 350:
        console.log("Precio Normal");
        break;
    case 500:
        console.log("Muy Caro");
        break;
    default:
        console.log("Precio Caro");
        break;
}

// LOOPS

// For loop

for (let i = 0; i <= 20; i++) {
    if (i % 2 === 0) {
        console.log(`Numero Par: ${i}`)
    }
}

// While loop
let i = 0;
while (i <= 20) {
    if (i % 2 === 1) {
        console.log(`Numero Impar: ${i}`)
    }
    i++
}

// Do While
let j = "hola "

do {
    j += j;
} while (j.length < 2);
console.log(j)


//forEach -- itera en un arregla aplicando en cada elemento una funcion dada, retorna undefined

const carrito = [
    { nombre: 'Monitor 20 Pulgadas', precio: 500 },
    { nombre: 'Televisión 50 Pulgadas', precio: 700 },
    { nombre: 'Tablet', precio: 300 },
    { nombre: 'Audifonos', precio: 200 },
    { nombre: 'Teclado', precio: 50 },
    { nombre: 'Celular', precio: 500 },
    { nombre: 'Bocinas', precio: 300 },
    { nombre: 'Laptop', precio: 800 }
];

console.log(carrito.forEach(producto => producto.disponible = true));

console.log(carrito);

//map -- itera en un arregla aplicando en cada elemento una funcion dada, retorna el arreglo con los cambios generados

console.log(carrito.map(producto => producto.fechaDeRegistro = "20/04/2023"));
console.log(carrito)