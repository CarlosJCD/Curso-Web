// Funciones

// Declarar funciones de manera tradicional

function addTwoNumbers(num1, num2) {
    return num1 + num2
}

console.log(addTwoNumbers(20, -2))

// Por medio de una expresion

const mutliplyTwoNumbers = function (num1, num2) {
    return num1 * num2
}

console.log(mutliplyTwoNumbers(12, -12))


    // Funciones IIFE (Inmediatly Invoked Function Expression) - Expresion de Funcion Invocadas Inmediatamente

    (function () {
        console.log(4 ** 2)
    })();

