(function () {

    obtenerTareasDelProyecto();



    const nuevaTareaBtn = document.querySelector('#agregar-tarea');
    nuevaTareaBtn.addEventListener('click', mostrarFormulario);

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

            const { tareas } = resultado;

            mostrarTareas(tareas);

        } catch (error) {
            console.log(error);
        }
    }

    function mostrarTareas(tareas) {
        if (tareas.length === 0) {
            const contenedorTareas = document.querySelector('#listado-tareas');
            const textoNoTareas = document.createElement('LI');
            textoNoTareas.textContent = 'No hay tareas por realizar';
            textoNoTareas.classList.add('no-tareas');
            contenedorTareas.appendChild(textoNoTareas);
            return;
        }

        tareas.forEach(tarea => {
            const contenedorTarea = document.createElement('LI');
            contenedorTarea.dataset.tareaId = tarea.id;
            contenedorTarea.classList.add('tarea');

            const nombreTarea = document.createElement("P");
            nombreTarea.textContent = tarea.nombre;
            contenedorTarea.appendChild(nombreTarea);

            console.log(contenedorTarea);
        })
    }

})();