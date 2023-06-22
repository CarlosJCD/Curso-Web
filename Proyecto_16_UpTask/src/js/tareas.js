(function () {
    const estadosTarea = {
        0: 'Pendiente',
        1: 'Completa'
    }

    let tareas = []
    let tareasFiltradas = []

    function main() {
        obtenerTareasDelProyecto();

        const nuevaTareaBtn = document.querySelector('#agregar-tarea');
        nuevaTareaBtn.addEventListener('click', function () {
            mostrarFormulario();
        });

        const filtros = document.querySelectorAll('#filtros input[type="radio"]');
        filtros.forEach(radio => {
            radio.addEventListener('input', filtrarTareas);
        });
    }

    function mostrarFormulario(cambiandoNombre = false, tarea = {}) {
        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
        <form class="formulario nueva-tarea">
            <legend>${cambiandoNombre ? 'Editar nombre de la tarea' : 'Añade una nueva tarea'}</legend>
            <div class="campo">
                <label for="tarea">Tarea</label>
                <input 
                type="text" 
                name="tarea" 
                placeholder=${tarea.nombre ? 'Edita la Tarea' : 'Añadir Tarea al Proyecto Actual'} 
                value = "${tarea.nombre ? tarea.nombre : ''}"
                id="tarea" />
            </div>
            <div class="opciones">
                <input type="submit" class="submit-nueva-tarea" value="${tarea.nombre ? 'Guardar Cambios' : 'Añadir Tarea'}">
                <button type="button" class="cerrar-modal">Cancelar</button>
            </div>
        </form>
        `;
        setTimeout(() => {
            const formularioNuevaTarea = document.querySelector('.formulario');
            formularioNuevaTarea.classList.add('animar');
        }, 0);

        modal.addEventListener('click', function (e) {
            e.preventDefault();

            if (e.target.classList.contains('cerrar-modal')) {
                const formulario = document.querySelector('.formulario');
                formulario.classList.add('cerrar');
                setTimeout(() => {
                    modal.remove();
                }, 500);
            }

            if (e.target.classList.contains('submit-nueva-tarea')) {
                const nombreTarea = document.querySelector('#tarea').value.trim();
                if (nombreTarea === '') {
                    mostrarAlerta('El Nombre de la tarea es Obligatorio', 'error', document.querySelector('.formulario legend'));
                    return;
                }

                if (cambiandoNombre) {
                    tarea.nombre = nombreTarea;
                    actualizarTarea(tarea);
                } else {
                    agregarTarea(nombreTarea);
                }
            }
        });

        document.querySelector('.dashboard').appendChild(modal);
    }

    function mostrarAlerta(mensaje, tipo, referencia) {
        const alertaPrevia = document.querySelector('.alerta');
        if (alertaPrevia) {
            alertaPrevia.remove();
        }

        const alerta = document.createElement('DIV');
        alerta.classList.add('alerta', tipo);
        alerta.textContent = mensaje;

        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }

    async function agregarTarea(nombreTarea) {
        const datos = new FormData();

        datos.append('nombre', nombreTarea);
        datos.append('proyectoUrl', obtenerUrlDelProyecto());

        try {
            const url = '/api/tarea';
            const respuesta = await fetch(url, {
                method: "POST",
                body: datos
            });
            const resultado = await respuesta.json();

            mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector('.formulario legend'));

            if (resultado.tipo === 'exito') {
                const modal = document.querySelector('.modal');
                setTimeout(() => {
                    modal.remove();
                }, 3000);

                const tareaNueva = {
                    id: String(resultado.id),
                    nombre: nombreTarea,
                    estado: 0,
                    proyectoId: resultado.proyectoId
                };
                tareas = [...tareas, tareaNueva];
                mostrarTareas();
            }
        } catch (error) {
            console.log(error);
        }
    }

    function obtenerUrlDelProyecto() {
        const proyectoParams = new URLSearchParams(window.location.search);

        const proyecto = Object.fromEntries(proyectoParams.entries());
        return proyecto.url;
    }

    async function obtenerTareasDelProyecto() {
        try {
            const url = `/api/tareas?url=${obtenerUrlDelProyecto()}`;
            const respuesta = await fetch(url);

            const resultado = await respuesta.json();

            tareas = resultado.tareas;

            mostrarTareas();

        } catch (error) {
            console.log(error);
        }
    }

    function mostrarTareas() {
        const listadoTareas = document.querySelector('#listado-tareas');
        limpiarTareas(listadoTareas);

        validarPendientes();
        validarCompletas();

        const arrayTareas = tareasFiltradas.length ? tareasFiltradas : tareas;

        if (arrayTareas.length === 0) {
            listadoTareas.appendChild(crearContenedorDeNoTareas());
            return;
        }


        arrayTareas.forEach(tarea => {
            listadoTareas.appendChild(crearContenedorTarea(tarea));
        })
    }

    function crearContenedorDeNoTareas() {
        const contenedorDeNoTareas = document.createElement('LI');
        contenedorDeNoTareas.textContent = 'No hay tareas por realizar';
        contenedorDeNoTareas.classList.add('no-tareas');
        return contenedorDeNoTareas;
    }

    function crearContenedorTarea(tarea) {
        const contenedorTarea = document.createElement('LI');
        contenedorTarea.dataset.tareaId = tarea.id;
        contenedorTarea.classList.add('tarea');

        contenedorTarea.appendChild(crearParrafoNombreTarea(tarea));
        contenedorTarea.appendChild(crearDivOpcionesTarea(tarea));

        return contenedorTarea;
    }

    function crearParrafoNombreTarea(tarea) {
        const parrafoNombreTarea = document.createElement("P");
        parrafoNombreTarea.textContent = tarea.nombre;

        parrafoNombreTarea.ondblclick = function () {
            mostrarFormulario(true, { ...tarea });
        }

        return parrafoNombreTarea;
    }

    function crearDivOpcionesTarea(tarea) {
        const opcionesDiv = document.createElement('DIV');
        opcionesDiv.classList.add('opciones');

        opcionesDiv.appendChild(crearBotonEstadoTarea(tarea));
        opcionesDiv.appendChild(crearBotonEliminarTarea(tarea));

        return opcionesDiv;

    }

    function crearBotonEstadoTarea(tarea) {
        const botonEstadoTarea = document.createElement('BUTTON');
        botonEstadoTarea.classList.add('estado-tarea');
        botonEstadoTarea.classList.add(`${estadosTarea[tarea.estado].toLowerCase()}`);
        botonEstadoTarea.textContent = estadosTarea[tarea.estado];
        botonEstadoTarea.dataset.estadoTarea = tarea.estado;

        botonEstadoTarea.ondblclick = function () {
            cambiarEstadoTarea({ ...tarea });
        }


        return botonEstadoTarea;
    }

    function crearBotonEliminarTarea(tarea) {
        const botonEliminarTarea = document.createElement('BUTTON');

        botonEliminarTarea.classList.add('eliminar-tarea');
        botonEliminarTarea.dataset.idTarea = tarea.id;
        botonEliminarTarea.textContent = 'Eliminar';

        botonEliminarTarea.ondblclick = function () {
            confirmarEliminarTarea({ ...tarea });
        }

        return botonEliminarTarea;
    }

    function limpiarTareas(listadoTareas) {
        while (listadoTareas.firstChild) {
            listadoTareas.removeChild(listadoTareas.firstChild);
        }
    }

    function cambiarEstadoTarea(tarea) {
        nuevoEstado = tarea.estado === "0" ? '1' : '0';
        tarea.estado = nuevoEstado;
        actualizarTarea(tarea);
    }

    async function actualizarTarea(tarea) {
        const { estado, id, nombre } = tarea;
        const datos = new FormData();

        datos.append('id', id);
        datos.append('nombre', nombre);
        datos.append('estado', estado);
        datos.append('proyectoUrl', obtenerUrlDelProyecto());

        try {
            const url = '/api/tarea/actualizar';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();
            if (resultado.tipo === 'exito') {

                Swal.fire(
                    resultado.mensaje,
                    resultado.mensaje,
                    'success'
                );

                const modal = document.querySelector('.modal');
                console.log(modal);
                if (modal) {
                    modal.remove();
                }


                tareas = tareas.map(tareaCargada => {
                    if (tareaCargada.id === id) {
                        tareaCargada.estado = estado;
                        tareaCargada.nombre = nombre;
                    }

                    return tareaCargada;
                });

                mostrarTareas();
            }
        } catch (error) {

        }
    }

    function confirmarEliminarTarea(tarea) {
        Swal.fire({
            title: `¿Eliminar Tarea?`,
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Si',
        }).then((result) => {
            if (result.isConfirmed) {
                eliminarTarea(tarea);
            }
        })
    }

    async function eliminarTarea(tarea) {
        const { estado, id, nombre } = tarea;
        const datos = new FormData();

        datos.append('id', id);
        datos.append('nombre', nombre);
        datos.append('estado', estado);
        datos.append('proyectoUrl', obtenerUrlDelProyecto());


        try {
            const url = '/api/tarea/eliminar';
            const respuesta = await fetch(url, {
                method: "POST",
                body: datos
            });

            const resultado = await respuesta.json();
            if (resultado.tipo === 'exito') {
                Swal.fire('Tarea eliminada correctamente', `La tarea '${nombre}' ha sido eliminada.`, 'success');
                tareas = tareas.filter(tareaCargada => tareaCargada.id !== id);
                mostrarTareas();

            }

        } catch (error) {
            console.log(error);
        }
    }

    function filtrarTareas(e) {
        const filtro = e.target.value;
        switch (filtro) {
            case '0':
            case '1':
                tareasFiltradas = tareas.filter(tarea => tarea.estado === filtro);
                break;
            default:
                tareasFiltradas = [];
                break;
        }
        mostrarTareas();
    }

    function validarPendientes() {
        const totalPendientes = tareas.filter(tarea => tarea.estado === '0');
        const pendientesRadio = document.querySelector('#pendientes')

        if (totalPendientes.length === 0) {
            pendientesRadio.disabled = true;
        } else {
            pendientesRadio.disabled = false;
        };
    }

    function validarCompletas() {
        const totalCompletas = tareas.filter(tarea => tarea.estado === '1');
        const completasRadio = document.querySelector('#completas')

        if (totalCompletas.length === 0) {
            completasRadio.disabled = true;
        } else {
            completasRadio.disabled = false;
        };
    }

    main();
})();
