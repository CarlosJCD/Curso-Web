const mobileMenuBoton = document.querySelector('#mobile-menu');
const sidebar = document.querySelector('.sidebar');

if (mobileMenuBoton) {
    mobileMenuBoton.addEventListener('click', function () {
        sidebar.classList.add('mostrar');
    });
}