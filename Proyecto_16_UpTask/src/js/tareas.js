(function () {
    const estadosTarea = {
        0: 'Pendiente',
        1: 'Completa'
    }

    let tareas = []

    function main() {
        obtenerTareasDelProyecto();

        const nuevaTareaBtn = document.querySelector('#agregar-tarea');
        nuevaTareaBtn.addEventListener('click', mostrarFormulario);
    }

    function mostrarFormulario() {
        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
        <form class="formulario nueva-tarea">
            <legend>Añade una nueva tarea</legend>
            <div class="campo">
                <label for="tarea">Tarea</label>
                <input type="text" name="tarea" placeholder="Añadir tarea al proyecto actual" id="tarea" />
            </div>
            <div class="opciones">
                <input type="submit" class="submit-nueva-tarea" value="Añadir Tarea">
                <button type="button" class="cerrar-modal">Cancelar</button>
            </div>
        </form>`;
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
                submitFormularioNuevaTarea();
            }
        });

        document.querySelector('.dashboard').appendChild(modal);
    }

    function submitFormularioNuevaTarea() {
        const nombreTarea = document.querySelector('#tarea').value.trim();
        if (nombreTarea === '') {
            mostrarAlerta('El Nombre de la tarea es Obligatorio', 'error', document.querySelector('.formulario legend'));
            return;
        }

        agregarTarea(nombreTarea);
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
        if (tareas.length === 0) {
            listadoTareas.appendChild(crearContenedorDeNoTareas());
            return;
        }

        tareas.forEach(tarea => {
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

        contenedorTarea.appendChild(crearParrafoNombreTarea(tarea.nombre));
        contenedorTarea.appendChild(crearDivOpcionesTarea(tarea));

        return contenedorTarea;
    }

    function crearParrafoNombreTarea(nombreTarea) {
        const parrafoNombreTarea = document.createElement("P");
        parrafoNombreTarea.textContent = nombreTarea;
        return parrafoNombreTarea;
    }

    function crearDivOpcionesTarea(tarea) {
        const opcionesDiv = document.createElement('DIV');
        opcionesDiv.classList.add('opciones');

        opcionesDiv.appendChild(crearBotonEstadoTarea(tarea));
        opcionesDiv.appendChild(crearBotonEliminarTarea(tarea.id));

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

    function crearBotonEliminarTarea(idTarea) {
        const botonEliminarTarea = document.createElement('BUTTON');
        botonEliminarTarea.classList.add('eliminar-tarea');
        botonEliminarTarea.dataset.idTarea = idTarea;
        botonEliminarTarea.textContent = 'Eliminar';

        return botonEliminarTarea;
    }

    function limpiarTareas(listadoTareas) {
        while (listadoTareas.firstChild) {
            listadoTareas.removeChild(listadoTareas.firstChild);
        }
    }

    function cambiarEstadoTarea(tarea) {
        tarea.estado = tarea.estado === "0" ? '1' : '0';
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
        } catch (error) {

        }
    }

    main();
})();
