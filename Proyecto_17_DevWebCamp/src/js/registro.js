import Swal from "sweetalert2";
(function () {
    const registroResumenDiv = document.querySelector('#registro-resumen');
    if (registroResumenDiv) {
        let eventos = [];
        mostrarEventos();
        const eventosBoton = document.querySelectorAll(".evento__agregar");
        const formularioRegistro = document.querySelector('#registro');

        eventosBoton.forEach(boton => boton.onclick = seleccionarEvento);

        formularioRegistro.addEventListener('submit', submitFormulario);

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

                });
            } else {
                const noRegistro = document.createElement('P');
                noRegistro.textContent = "Porfavor, selecciona los eventos a los que deseas asistir.";
                noRegistro.classList.add('registro__texto');
                registroResumenDiv.appendChild(noRegistro);
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

        async function submitFormulario(e) {
            e.preventDefault();

            const regaloId = document.querySelector('#regalo').value;
            const eventosId = eventos.map(evento => { return evento.id; });

            if (eventosId.length === 0 || regaloId === '') {
                switch (true) {
                    case (eventosId.length === 0):
                        Swal.fire({
                            title: 'Advertencias',
                            text: "Porfavor, selecciona al menos un evento al cual asistir",
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                        break;
                    case (regaloId === ''):
                        Swal.fire({
                            title: 'Advertencias',
                            text: "Porfavor, selecciona un regalo",
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                        break;
                    default:
                        console.log(eventosId);
                        console.log(regaloId);
                        break;
                }
                return;
            }

            const datos = new FormData();

            datos.append('eventos', eventosId);
            datos.append('regalo_id', regaloId);

            const url = '/finalizar-registro/conferencias';
            const respuesta = await fetch(url, {
                method: "POST",
                body: datos
            });


            const resultado = await respuesta.json();

            if (resultado.resultado) {

            } else {
                Swal.fire({
                    title: resultado.titulo,
                    text: resultado.mensaje,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }


        }

    }

})();