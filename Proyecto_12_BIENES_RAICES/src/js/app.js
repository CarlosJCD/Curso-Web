function main() {
    barraMenu();
}

function barraMenu() {
    document.addEventListener('DOMContentLoaded', function () {
        eventListeners();
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

main();