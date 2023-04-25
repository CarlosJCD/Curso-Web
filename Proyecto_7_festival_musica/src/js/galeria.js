document.addEventListener('DOMContentLoaded', function () {
    main();
})

function main() {
    navbarFija();
    crearGaleria();
    smoothScroll();
}

function crearGaleria() {
    const galeria = document.querySelector('.galeria-imagenes');
    for (let i = 1; i <= 12; i++) {
        const imagen = document.createElement('picture');
        imagen.innerHTML = `
        <source srcset="build/img/thumb/${i}.avif" type="image/avif" />
        <source srcset="build/img/thumb/${i}.webp" type="image/webp" />
        <img loading="lazy" width="200" height="300" src="build/img/thumb/${i}.jpg" alt="imagen galeria ${i}" />
        `;
        imagen.onclick = () => mostrarImagen(i);
        galeria.appendChild(imagen);
    }
}

function mostrarImagen(id) {

    const imagen = document.createElement('picture');
    imagen.innerHTML = `
    <source srcset="build/img/grande/${id}.avif" type="image/avif" />
    <source srcset="build/img/grande/${id}.webp" type="image/webp" />
    <img loading="lazy" width="200" height="300" src="build/img/grande/${id}.jpg" alt="imagen galeria ${id}" />
    `;

    const botonCerrarFoto = document.createElement('P');
    botonCerrarFoto.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-letter-x" width="48" height="48" viewBox="0 0 24 24" stroke-width="3" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
    <line x1="7" y1="4" x2="17" y2="20" />
    <line x1="17" y1="4" x2="7" y2="20" />
    </svg>
    `;
    botonCerrarFoto.classList.add('boton-foto');
    botonCerrarFoto.onclick = () => {
        const body = document.querySelector("body");
        body.classList.remove('fijar-body')
        overlay.remove()
    };

    const enlaceParaDescargar = document.createElement('a');
    enlaceParaDescargar.href = `build/img/grande/${id}.jpg`;
    enlaceParaDescargar.download = 'Imagen festival.jpg';

    const botonDescargarImagen = document.createElement('P');
    botonDescargarImagen.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="48" height="48" viewBox="0 0 24 24" stroke-width="3" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
    <polyline points="7 11 12 16 17 11" />
    <line x1="12" y1="4" x2="12" y2="16" />
    </svg>
    `;
    botonDescargarImagen.classList.add('boton-foto');
    botonDescargarImagen.onclick = () => enlaceParaDescargar.click();

    const botonesOverlay = document.createElement("DIV");
    botonesOverlay.classList.add("overlay-botones");
    botonesOverlay.appendChild(botonCerrarFoto);
    botonesOverlay.appendChild(botonDescargarImagen);

    const overlay = document.createElement('DIV');
    overlay.classList.add('overlay');
    overlay.appendChild(imagen);
    overlay.appendChild(botonesOverlay);
    overlay.onclick = () => {
        const body = document.querySelector("body");
        body.classList.remove('fijar-body')
        overlay.remove()
    };

    const body = document.querySelector("body");
    body.appendChild(overlay);
    body.classList.add('fijar-body');
}

function smoothScroll() {
    const enlacesNavegacion = document.querySelectorAll('.navegacion-principal a');
    enlacesNavegacion.forEach(enlace => {
        enlace.addEventListener('click', function (e) {
            e.preventDefault();
            const idSeccion = e.target.attributes.href.value;
            const seccion = document.querySelector(idSeccion);
            seccion.scrollIntoView({ behavior: 'smooth' });

        });
    });
}

function navbarFija() {
    const header = document.querySelector('.header');
    const seccionSobreFestival = document.querySelector('.sobre-festival');
    const body = document.querySelector('body');

    window.addEventListener('scroll', function () {
        if (seccionSobreFestival.getBoundingClientRect().bottom < 0) {
            header.classList.add('fijo');
            body.classList.add('body-scroll');
        } else {
            header.classList.add('fijo');
            body.classList.remove('body-scroll');
        }
    });
}