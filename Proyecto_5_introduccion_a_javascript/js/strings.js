// maneras de crear strings

const CURP = "AUGM770826MCSGRR68"; // String
let diaDeLaSemanaActual = 'Martes'; // String
let stringComoObjeto = new String("String como objeto!!") // Object

console.log(CURP)
console.log(diaDeLaSemanaActual)
console.log(stringComoObjeto)


/* Metodos de strings*/

//length (length es un atributo!!!!!!)
console.log("Dia de la semana: " + diaDeLaSemanaActual + ", Numero de caracteres de la cadena: " + diaDeLaSemanaActual.length)

//indexOf (indexamiento empezando en 0)
let randomString = "xu5355aabhfh4bcazhks";

console.log(`String: ${randomString}, Posicion de la letra 'b': ${randomString.indexOf('b')}`)

//includes

const diasDeTrabajo = "Lunes Martes Miercoles Jueves Viernes Sabado"

console.log(`Dias de Trabajo: ${diasDeTrabajo}`)
console.log(`¿Trabajo el Lunes?: ${diasDeTrabajo.includes('Lunes')}`)
console.log(`¿Trabajo el Domingo?: ${diasDeTrabajo.includes('Domingo')}`)