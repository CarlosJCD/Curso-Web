
let paso = 1;

document.addEventListener('DOMContentLoaded', function () {
    main();
});

function main() {
    cambiarSeccionSegunElTab();
}

function cambiarSeccionSegunElTab() {
    const botones = document.querySelectorAll('.tabs button');
    mostrarSeccion(paso)
    botones.forEach(boton => {
        boton.addEventListener('click', function (e) {
            let paso = parseInt(e.target.dataset.paso);
            mostrarSeccion(paso);
        })
    });
}

function mostrarSeccion(paso) {
    const seccionAnterior = document.querySelector('.mostrar');
    if (seccionAnterior) {

        seccionAnterior.classList.remove('mostrar');
    }

    const seccion = document.querySelector(`#paso-${paso}`);
    console.log(seccion);
    seccion.classList.add('mostrar');


    const tabAnterior = document.querySelector('.actual');
    tabAnterior.classList.remove('actual');


    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual')
}