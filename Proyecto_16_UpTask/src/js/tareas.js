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
        }, 3000);

        document.querySelector('body').appendChild(modal);
    }
})();