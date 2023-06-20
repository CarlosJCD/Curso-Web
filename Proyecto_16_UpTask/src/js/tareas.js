(function () {
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

        document.querySelector('body').appendChild(modal);
    }

    function submitFormularioNuevaTarea() {
        const nombreTarea = document.querySelector('#tarea').value.trim();
        console.log(nombreTarea);
        if (nombreTarea === '') {
            // Mostrar una alerta de error
            console.log('El Nombre de la tarea es Obligatorio ');
            return;
        }
    }

})();