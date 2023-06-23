const mobileMenuBoton = document.querySelector('#mobile-menu');
const cerrarMenuBoton = document.querySelector('#cerrar-menu');
const sidebar = document.querySelector('.sidebar');

if (mobileMenuBoton) {
    mobileMenuBoton.addEventListener('click', function () {
        sidebar.classList.add('mostrar');
    });
}

if (cerrarMenuBoton) {
    cerrarMenuBoton.addEventListener('click', function () {
        sidebar.classList.add('ocultar');
        setTimeout(() => {
            sidebar.classList.remove('mostrar');
            sidebar.classList.remove('ocultar');
        }, 1000)

    });
}