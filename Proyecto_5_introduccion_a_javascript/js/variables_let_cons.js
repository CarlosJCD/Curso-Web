//Palabras reservadas let y cons


/* 
- Constantes no cambian su valor durante la ejecucion del programa
- Las constantes se suelen escribir en MAYUSCULAS
- Si se intenta reasignar una variable definida con la palabra reservada "const", el interprete de JavaScript lanzará un error

*/
const CONTANTE = "Hola!, Soy una constante!!";

// CONTANTE = "Oh Oh!"; // TypeError: Attempted to assign to readonly property

/*
Var y Let

Sobreescritura:
Con var puedes sobreescribir variables con el mismo nombre, mientras que con let no te lo permite


Alcance de las variables (Scope):

Cuando se declara una variable con var, puee tener un alcance local (en toda la funcion) o global (en todo el programa).

Cuando se declara con let, esta tiene un alcane limitado al bloque en la que se declaró, ya sea globalmmente, dentro de una funcion, o dentro de algun bloque de alguna estructura de control

*/