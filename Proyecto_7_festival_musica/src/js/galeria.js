document.addEventListener('DOMContentLoaded', function () {
    main();
})

function main() {
    crearGaleria();
}

function crearGaleria() {
    const galeria = document.querySelector('.galeria-imagenes');
    galeria.textContent = "Huola";
}