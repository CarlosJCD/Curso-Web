

/*
Seleccionar contenido

1.- querySelector

2.- querySelectorAll

*/

// querySelector -- Retorna el 1er elemento que encuentre o null si no encuentra ninguno

// const heading = document.querySelector('.header__texto h2');
// heading.textContent = "Nuevo heading";
// console.log(heading);

// // querySelectorAll -- Retorna todos los elementos que coincidan 
// const enlaces = document.querySelectorAll('.navegacion a');


// const nuevoEnlace = document.createElement("A");

// nuevoEnlace.href = "nuevo-enlace.hmtl";

// nuevoEnlace.textContent = "Nuevo Enlace";

// nuevoEnlace.classList.add("navegacion__enlace");

// const barraDeNavegacion = document.querySelector('.navegacion');

// barraDeNavegacion.appendChild(nuevoEnlace);

// // Eventos

// window.addEventListener('load', function (evento) {
//     console.log(evento);
// });

// document.addEventListener('DOMContentLoaded', function (evento) {
//     console.log(evento);
// });

// window.onscroll = () => console.log('scrolling...');

// asociar eventos a elementos de html

// Eventos con el teclado


const datos = {
    nombre: "",
    email: "",
    mensaje: "",
}
// Primer elemento con id "nombre"
const inputNombre = document.querySelector("#nombre");
// Primer elemento con id "email"
const inputEmail = document.querySelector("#email");
// Primer elemento con id "mensaje"
const inputMensaje = document.querySelector("#mensaje");
// Primer elemento con la clase "boton--primario"
const botonEventoEnviar = document.querySelector('.boton--primario');

//validar un formulario
const formulario = document.querySelector(".formulario");

// Escribiendo en el elemento seleccionado por inputNombre
inputNombre.addEventListener("input", actualizarAtributoDatos);

// Escribiendo en el elemento seleccionado por inputEmail
inputEmail.addEventListener("input", actualizarAtributoDatos);

// Escribiendo en el elemento seleccionado por inputMensaje
inputMensaje.addEventListener("input", actualizarAtributoDatos);

// Click al elemento  seleccionado por botonEventoEnviar
botonEventoEnviar.addEventListener('click', function (evento) {
    evento.preventDefault()
    console.log(datos);
});

formulario.addEventListener("submit", function (evento) {
    evento.preventDefault();
    console.log("enviando formulario...");
});

function actualizarAtributoDatos(evento) {
    const idCampo = evento.target.id;
    const valorCampo = evento.target.value;
    datos[idCampo] = valorCampo;
}