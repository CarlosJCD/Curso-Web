//Arrays o Arreglos


// Al igual que con los objetos, const no impide la modificacion del arreglo actual.
const estudiantesMentoria = ["Carlos", "Carlos", "Fernando", "Cristian", "Kevin", "Oswaldo", "Alfonso"];
console.log(estudiantesMentoria);

estudiantesMentoria[0] = "Javier";
console.table(estudiantesMentoria);

// estudiantesMentoria = ["Otro", "arreglo", "distinto"]; -- TypeError, attempted to reasign readonly property

// Los arrays pueden contener multiples tipos de datos a la vez, inclusive otros arreglos

const multiplesDatos = ["Hola", 50, false, null, undefined, ["Arreglo en arreglo!!"], { texto: "objeto en arreglo!!" }];
console.log(multiplesDatos)

// En los arreglos se puede acceder a sus elemenntos a traves de sus indices:

let primerElemento = estudiantesMentoria[0];
let segundoElemento = estudiantesMentoria[1];
let tercerElemento = estudiantesMentoria[2];
console.log(primerElemento);
console.log(segundoElemento);
console.log(tercerElemento);

// la propiedad length tambien existe en los arreglos.
let numElementosDelArreglo = multiplesDatos.length

//forEach --  recorre todo el arreglo elemento por elemento 
estudiantesMentoria.forEach(function (estudiante) {
    console.log(`Estudiante: ${estudiante}`)
})

//METODOS ARREGLOS

//Insertar al final del arreglo:
multiplesDatos[multiplesDatos.length] = "Insertar con corchetes";
multiplesDatos.push("Insertar como si fuera una pila");

//Insertar al principio del arreglo:
multiplesDatos.unshift("Estoy al principio!!");

//Eliminar elementos del arreglo:
multiplesDatos.pop(); // elimina el ultimo del arreglo
multiplesDatos.shift(); // elimina el primero del arreglo
multiplesDatos.splice(2, 1); // .splice(m, n) : elimina los siguientes n elementos partiendo del elemento en la posicion m

/*Otro enfoque para interactuar con arreglos es no modificar el original, sino obtener copias del original con las 
modificaciones necesarias (sigue la misma idea que en el paradigma funcional, donde solo hay constantes y las funciones
    para modificar una constante retornan la copia de esa constante con el cambio correspondiente)
*/

//Añadir elementosl: operador spread o rest
const multiplesDatosMasUnoAlFinal = [...multiplesDatos, 19];
const multiplesDatosMasUnoAlPrincipio = [23, ...multiplesDatos];

// Mas metodos de arrays:

//Includes - Valida si un elemento esta en el array (no funciona bien para objetos)

const algunosMeses = ["Enero", "Febrero", "Agosto", "Julio"];
console.log(algunosMeses.includes("Diciembre"));

// Some - Valida si un objeto se encuentra en el arreglo por medio de la validacion de una propiedad

const comestibles = [
    { nombre: "Queso", Tipo: "Lacteo" },
    { nombre: "Yoghurt", Tipo: "Lacteo" },
    { nombre: "Jamon", Tipo: "De origen animal" },
    { nombre: "Huevo", Tipo: "De origen animal" },
    { nombre: "Leche", Tipo: "Lacteo" },
];

comestibles.some(producto => producto.nombre === "Leche")



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


// Reduce - El método reduce JavaScript nos permite, como su nombre indica, reducir el array insertado a un solo valor


let resultado = carrito.reduce(function (total, producto) {
    return total + producto.precio
}, 0);

console.log(resultado)

// Filter - crea un nuevo array con todos los elementos que cumplan la condición implementada por la función dada.
resultado = carrito.filter(function (producto) {
    return producto.precio > 400
});

console.log(resultado)
resultado = carrito.filter(function (producto) {
    return producto.nombre !== 'Celular'
});

console.log(resultado)