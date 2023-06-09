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

function mostrarMetodoDeContacto(e) {
    const contactoDiv = document.querySelector("#contacto");
    switch (e.target.value) {
        case "telefono":
            contactoDiv.innerHTML = `
                <label for="telefono">Numero de Teléfono</label>
                <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]" />

                <p>Elija la fecha y hora para la llamada</p>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="contacto[fecha]" />
    
                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]" />
            `;
            break;
        case 'email':
            contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" />
            `;
            break;
        default:
            break;
    }

}



main();