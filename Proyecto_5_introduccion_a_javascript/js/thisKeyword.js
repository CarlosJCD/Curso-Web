// this Keyword

const reservacion = {
    nombre: "Carlos",
    apellido: "Calderon",
    edad: "19 años",
    toString: function () {
        return `Nombre Completo: ${this.nombre} ${this.apellido} -- Edad: ${this.edad}`
    }
}

console.log(reservacion.toString())

/* IMPORTANTE: 
Con arrow function la palabra clave "this" deja de hacer referencia al objeto en el alcance local y 
hace refencia al objeto "Window", por lo tanto no es recomendable es uso de "this" cuando se declare 
una arrow function 
*/