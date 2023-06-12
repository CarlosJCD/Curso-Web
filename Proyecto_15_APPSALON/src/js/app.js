let paso = 1;

document.addEventListener('DOMContentLoaded', function () {
    main();
});

function main() {
    cambiarSeccionSegunElTab();
}

function cambiarSeccionSegunElTab() {
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton => {
        boton.addEventListener('click', function (e) {
            let paso = parseInt(e.target.dataset.paso);
            mostrarSeccion(paso);
        })
    });
}

function mostrarSeccion(paso) {

}