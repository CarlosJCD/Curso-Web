
let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded', function () {
    main();
});

function main() {

    mostrarSeccion();
    cambiarSeccionSegunElTab();
    botonesDelPaginador();
    paginaSiguiente();
    paginaAnterior();

    consultarAPI();

    obtenerIdCliente();
    obtenerNombreCliente();
    obtenerFechaCita();
    obtenerHoraCita();
    mostrarResumenCita();

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
            mostrarResumenCita();
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
        const url = "/api/servicios";
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    servicios.forEach(servicio => {
        const { id, nombre, precio } = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function () {
            seleccionarServicio(servicio);
        }

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector("#servicios").appendChild(servicioDiv);
    });
}

function seleccionarServicio(servicioSeleccionado) {
    const { id } = servicioSeleccionado
    const { servicios } = cita
    const divServicioSeleccionado = document.querySelector(`[data-id-servicio="${servicioSeleccionado.id}"]`);

    if (servicios.some(servicioAñadido => servicioAñadido.id === servicioSeleccionado.id)) {
        cita.servicios = servicios.filter(serviciosGuardados => serviciosGuardados.id !== id);
        divServicioSeleccionado.classList.remove('seleccionado');
    } else {
        cita.servicios.push(servicioSeleccionado);
        divServicioSeleccionado.classList.add('seleccionado');
    }
}

function obtenerIdCliente() {
    cita.id = document.querySelector('#id').value;

}

function obtenerNombreCliente() {
    cita.nombre = document.querySelector('#nombre').value;
}

function obtenerFechaCita() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function (e) {

        const dia = new Date(e.target.value).getUTCDay();
        if ([6, 0].includes(dia)) {
            e.target.value = '';
            mostrarAlerta('Fines de semana no permitidos', 'error', '.formulario');
        } else {
            cita.fecha = e.target.value;
        }

    });
}

function obtenerHoraCita() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function (e) {


        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];
        if (hora < 10 || hora > 18) {
            e.target.value = '';
            mostrarAlerta('Horario de trabajo: 10:00 a 18:00 horas', 'error', '.formulario');
        } else {
            cita.hora = e.target.value;
        }
    })
}

function mostrarResumenCita() {
    const seccionResumen = document.querySelector('.contenido-resumen');
    while (seccionResumen.firstChild) {
        seccionResumen.removeChild(seccionResumen.firstChild);
    }

    if (Object.values(cita).includes('') || cita.servicios.length === 0) {
        mostrarAlerta('Faltan datos de Servicios, Fecha u Hora', 'error', '.contenido-resumen', false);

        return;
    }

    const { nombre, fecha, hora, servicios } = cita;

    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de Servicios';
    seccionResumen.appendChild(headingServicios);

    desplegarServiciosEnElResumen(servicios, seccionResumen);

    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de Cita';
    seccionResumen.appendChild(headingCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    const fechaFormateada = formatearFecha(fecha);

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora} Horas`;

    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Reservar Cita';
    botonReservar.onclick = reservarCita;

    seccionResumen.appendChild(nombreCliente);
    seccionResumen.appendChild(fechaCita);
    seccionResumen.appendChild(horaCita);

    seccionResumen.appendChild(botonReservar);

}

function desplegarServiciosEnElResumen(servicios, seccionResumen) {
    servicios.forEach(servicio => {
        const { id, precio, nombre } = servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio:</span> $${precio}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        seccionResumen.appendChild(contenedorServicio);
    });
}

function formatearFecha(fecha) {
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year, mes, dia));

    const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
    return fechaUTC.toLocaleDateString('es-MX', opciones);
}

async function reservarCita() {
    const { id, fecha, hora, servicios } = cita;

    const idServicios = servicios.map(servicio => servicio.id);

    const datos = new FormData();
    datos.append('usuarioId', id)
    datos.append('fecha', fecha)
    datos.append('hora', hora)
    datos.append('servicios', idServicios)
    const url = "/api/citas";
    try {
        const response = await fetch(url, {
            method: "POST",
            body: datos
        });

        const resultado = await response.json();

        if (resultado.resultado) {
            Swal.fire({
                icon: 'success',
                title: 'Cita Creada',
                text: 'Tu cita fue creada correctamente',
                showConfirmButton: true
            }).then(() => {
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            })
        }

    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error al crear la cita',
            text: 'Porfavor, intentelo de nuevo mas tarde',
            showConfirmButton: true
        })
    }




}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {

    const alertaPrevia = document.querySelector('.alerta');
    if (alertaPrevia) {
        alertaPrevia.remove();
    }

    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if (desaparece) {
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }

}