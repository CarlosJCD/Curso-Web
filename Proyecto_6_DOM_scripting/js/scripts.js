

/*
Seleccionar contenido

1.- querySelector

2.- querySelectorAll

3.- getElementById

*/

// querySelector -- Retorna el 1er elemento que encuentre o null si no encuentra ninguno

const heading = document.querySelector('.header__texto h2');
heading.textContent = "Nuevo heading";
console.log(heading);

// querySelectorAll -- Retorna todos los elementos que coincidan 
const enlaces = document.querySelectorAll('.navegacion a');
console.log(enlaces[0]);
enlaces[0].textContent = 'Sample text';
enlaces[0].href = 'http://google.com';

// getElementById

const heading2 = document.getElementById();