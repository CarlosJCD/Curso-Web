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

console.log(estudianteActual)

console.log(`Nombre Completo: ${estudianteActual.nombre} ${estudianteActual.segundoNombre} ${estudianteActual.apellidoPaterno} ${estudianteActual.apellidoMaterno}`)