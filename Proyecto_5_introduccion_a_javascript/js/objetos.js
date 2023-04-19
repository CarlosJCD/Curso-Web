"use-strict"; // Modo estricto de javascript : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Strict_mode
//objetos

/* 
Mientras que en java se le conoce como objeto a la instancia de una clase, 
en JavaScript se conoce como objetos los hashmaps, 
que son estructuras de datos que contienen informacion con la fomra de llave-valor.
*/

let estudianteActual = {
    nombre: "Carlos",
    segundoNombre: "Javier",
    apellidoPaterno: "Calderon",
    apellidoMaterno: "Delgado",
    edadEnAños: 19,
    licenciatura: "Ingenieria de Software",
    egresado: false,
    asignaturasSemestreActual: ["Diseño de Software", "Teoria de Lenguajes de Programacion", "Probabilidad", "Estructuras de Datos", "Sistemas Operativos"]
}

console.log(estudianteActual);

console.log(`Nombre Completo: ${estudianteActual.nombre} ${estudianteActual.segundoNombre} ${estudianteActual.apellidoPaterno} ${estudianteActual.apellidoMaterno}`);

/*Oeracioes con objetos */

//Modificar llaves existentes:
estudianteActual.edadEnAños += 1;
console.log(estudianteActual);

// Elimnar una llave:
delete estudianteActual.asignaturasSemestreActual
console.log(estudianteActual);

//Añadir una llave

estudianteActual.genero = "Hombre Heterosexual";

//Destructuring (obtener y almacenar valores de llaves en variables)

let { edadEnAños } = estudianteActual;
let { nombre, segundoNombre, apellidoPaterno, apellidoMaterno } = estudianteActual;
console.log(`Edad: ${edadEnAños}`)
console.log(`Nombre Completo: ${nombre} ${segundoNombre} ${apellidoPaterno} ${apellidoMaterno} `)
console.log(estudianteActual)

// Metodos de Objetos:

//Object.freeze() -- Convierte un objeto en una constante: "only-reading mode"

//Object.isFrozen() -- Valida si un objeto esta en el modo de solo lectura

//Object.seal() -- Solo permite la modificacion de llaves existente, no permite la adicion o eliminacion de llaves.

// Union de dos objetos

let infoAcademica = {
    estado: "regular",
    semestreEquivalente: "4o",
    promedioActual: "89"
}

estudianteActual = { ...estudianteActual, ...infoAcademica }

console.log(estudianteActual)
