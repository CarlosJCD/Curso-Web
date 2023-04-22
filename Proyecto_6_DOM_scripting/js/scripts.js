

/*
Seleccionar contenido

1.- querySelector

2.- querySelectorAll

*/

// querySelector -- Retorna el 1er elemento que encuentre o null si no encuentra ninguno

const heading = document.querySelector('.header__texto h2');
heading.textContent = "Nuevo heading";
console.log(heading);

// querySelectorAll -- Retorna todos los elementos que coincidan 
const enlaces = document.querySelectorAll('.navegacion a');


const nuevoEnlace = document.createElement("A");

nuevoEnlace.href = "nuevo-enlace.hmtl";

nuevoEnlace.textContent = "Nuevo Enlace";

nuevoEnlace.classList.add("navegacion__enlace");

const barraDeNavegacion = document.querySelector('.navegacion');

barraDeNavegacion.appendChild(nuevoEnlace);

// Eventos

window.addEventListener('load', function (evento) {
    console.log(evento);
});

document.addEventListener('DOMContentLoaded', function (evento) {
    console.log(evento);
});

window.onscroll = () => console.log('scrolling...');

// asociar eventos a elementos de html

const botonEventoEnviar = document.querySelector('.boton--primario');

botonEventoEnviar.addEventListener('click', function (evento) {
    evento.preventDefault()
    console.log(evento);
});