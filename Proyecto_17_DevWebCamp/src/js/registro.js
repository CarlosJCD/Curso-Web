import Swal from "sweetalert2";
(function () {
    const registroResumenDiv = document.querySelector('#registro-resumen');
    if (registroResumenDiv) {
        let eventos = [];
        const eventosBoton = document.querySelectorAll(".evento__agregar");
        eventosBoton.forEach(boton => boton.onclick = seleccionarEvento);

        function seleccionarEvento(e) {
            if (eventos.length < 5) {
                eventos = [...eventos, {
                    id: e.target.dataset.id,
                    titulo: e.target.parentElement.querySelector('.evento__nombre').textContent.trim()
                }]
                e.target.disabled = true

                mostrarEventos();
            } else {
                Swal.fire({
                    title: 'Error',
                    text: "Maximo 5 eventos por registro",
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }

        }

        function mostrarEventos() {
            limpiarEventos();
            if (eventos.length > 0) {
                eventos.forEach(evento => {
                    const eventoDOM = crearDIVEvento(evento);
                    registroResumenDiv.appendChild(eventoDOM);

                })
            }
        }

        function limpiarEventos() {
            while (registroResumenDiv.firstChild) {
                registroResumenDiv.removeChild(registroResumenDiv.firstChild);
            }
        }

        function crearDIVEvento(evento) {

            const eventoDOM = document.createElement('DIV');
            eventoDOM.classList.add("registro__evento");

            const titulo = crearTituloEvento(evento);
            const botonEliminar = crearBotonEliminarEvento(evento);

            eventoDOM.appendChild(titulo);
            eventoDOM.appendChild(botonEliminar);

            return eventoDOM;
        }

        function crearTituloEvento({ titulo }) {
            const tituloDiv = document.createElement('H3');
            tituloDiv.classList.add('registro__nombre');
            tituloDiv.textContent = titulo;

            return tituloDiv;
        }

        function crearBotonEliminarEvento({ id }) {
            const botonEliminar = document.createElement('BUTTON');
            botonEliminar.classList.add('registro__eliminar');
            botonEliminar.innerHTML = `<i class="fa-solid fa-xmark"></i>`
            botonEliminar.onclick = () => { eliminarEvento(id); }

            return botonEliminar;
        }

        function eliminarEvento(id) {
            eventos = eventos.filter(evento => evento.id != id);

            const eventoEliminado = document.querySelector(`[data-id="${id}"]`);
            eventoEliminado.disabled = false;

            mostrarEventos();


        }

    }

})();