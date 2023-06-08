function main() {
    document.addEventListener('DOMContentLoaded', function () {
        eventListeners();
        darkMode();
    });
}

function eventListeners() {
    const menuEnMovil = document.querySelector('.mobile-menu');
    menuEnMovil.addEventListener('click', mostrarNavBar)

    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodoDeContacto));

}

function mostrarNavBar() {
    const elementosNavegacion = document.querySelector('.navegacion');
    elementosNavegacion.classList.toggle('mostrar');
}

function darkMode() {
    const prefiereModoOscuro = window.matchMedia('(prefers-color-scheme: dark)');

    if (prefiereModoOscuro.matches)
        document.body.classList.add('dark-mode');
    else
        document.body.classList.remove('dark-mode');

    prefiereModoOscuro.addEventListener('change', function () {

        if (prefiereModoOscuro.matches)
            document.body.classList.add('dark-mode');
        else
            document.body.classList.remove('dark-mode');
    });
    const botonModoOscuro = document.querySelector('.dark-mode-boton');
    botonModoOscuro.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    });
}

function mostrarMetodoDeContacto() {

}



main();