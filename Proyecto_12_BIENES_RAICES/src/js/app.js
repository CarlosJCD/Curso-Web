function main() {
    document.addEventListener('DOMContentLoaded', function () {
        eventListeners();
        darkMode();
    });
}

function eventListeners() {
    const menuEnMovil = document.querySelector('.mobile-menu');
    menuEnMovil.addEventListener('click', mostrarNavBar)
}

function mostrarNavBar() {
    const elementosNavegacion = document.querySelector('.navegacion');
    elementosNavegacion.classList.toggle('mostrar');
}

function darkMode() {
    const botonModoOscuro = document.querySelector('.dark-mode-boton');
    botonModoOscuro.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    });
}


main();