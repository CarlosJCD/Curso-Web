// Object Literal && Object Constructor


// Object literal -- objetos en variables

const estudiante = {
    nombre: "Carlos",
    genero: "Masculino"
}
console.log(estudiante)

// Object Constructor -- funcion generadora de objetos

function Estudiante(nombre, genero) {
    this.nombre = nombre,
        this.genero = genero
}

const estudiante2 = new Estudiante("Javier", "Masculino")

console.log(estudiante2);