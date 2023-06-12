
let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;
const BASE_DIR = "/Curso-Web/Proyecto_15_APPSALON/public/index.php";

document.addEventListener('DOMContentLoaded', function () {
    main();
});

function main() {
    mostrarSeccion(paso)
    cambiarSeccionSegunElTab();
    botonesDelPaginador();
    paginaSiguiente();
    paginaAnterior();
    consultarAPI();
}

function cambiarSeccionSegunElTab() {
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton => {
        boton.addEventListener('click', function (e) {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            botonesDelPaginador();
        })
    });
}

function mostrarSeccion() {
    const seccionAnterior = document.querySelector('.mostrar');
    if (seccionAnterior) {

        seccionAnterior.classList.remove('mostrar');
    }

    const seccion = document.querySelector(`#paso-${paso}`);
    seccion.classList.add('mostrar');


    const tabAnterior = document.querySelector('.actual');
    tabAnterior.classList.remove('actual');


    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual')
}

function botonesDelPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    switch (paso) {
        case 1:
            paginaAnterior.classList.add('ocultar');
            paginaSiguiente.classList.remove('ocultar');
            break;
        case 2:
            paginaAnterior.classList.remove('ocultar');
            paginaSiguiente.classList.remove('ocultar');
            break;
        case 3:
            paginaAnterior.classList.remove('ocultar');
            paginaSiguiente.classList.add('ocultar');
            break;
        default:
            break;
    }
    mostrarSeccion();
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function () {

        if (paso <= pasoInicial) return;
        paso--;

        botonesDelPaginador();
    })
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function () {

        if (paso >= pasoFinal) return;
        paso++;

        botonesDelPaginador();
    })
}

async function consultarAPI() {
    try {
        const url = "http://localhost" + BASE_DIR + "/api/servicios";
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        console.log(servicios);
    } catch (error) {
        console.log(error);
    }
}