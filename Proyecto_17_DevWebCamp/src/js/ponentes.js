(
    function () {
        const ponentesInput = document.querySelector('#ponentes');

        if (ponentesInput) {
            let ponentes = [];
            let ponentesFiltrados = [];

            const listadoPonentes = document.querySelector('#listado-ponentes');
            const inputHiddenPonenteId = document.querySelector('[name="ponente_id"]');

            ponentesInput.addEventListener('input', buscarPonentes);

            obtenerPonentes();

            async function obtenerPonentes() {
                const url = `/api/ponentes`;

                const respuesta = await fetch(url);
                const resultado = await respuesta.json();

                formatearPonentes(resultado);
            }

            function formatearPonentes(arrayPonentes = []) {
                ponentes = arrayPonentes.map(ponente => {
                    return {
                        nombre: `${ponente.nombre} ${ponente.apellido}`,
                        id: ponente.id
                    };
                });
            }

            function buscarPonentes(e) {
                const busqueda = e.target.value;
                if (busqueda.length > 1) {
                    const expresion = new RegExp(busqueda, 'i');
                    ponentesFiltrados = ponentes.filter(ponente => {
                        if (ponente.nombre.toLowerCase().search(expresion) != -1) {
                            return ponente;
                        }
                    });
                } else {
                    ponentesFiltrados = [];
                }
                mostrarPonentes();
            }

            function mostrarPonentes() {
                while (listadoPonentes.firstChild) {
                    listadoPonentes.removeChild(listadoPonentes.firstChild);
                }

                if (ponentesFiltrados.length > 0) {
                    ponentesFiltrados.forEach(ponente => {
                        const ponenteHTML = document.createElement('LI');
                        ponenteHTML.classList.add('listado-ponentes__ponente');
                        ponenteHTML.textContent = ponente.nombre;
                        ponenteHTML.dataset.ponenteId = ponente.id;
                        ponenteHTML.onclick = seleccionarPonente;

                        listadoPonentes.appendChild(ponenteHTML);
                    });
                } else {
                    const noResultados = document.createElement('P');
                    noResultados.classList.add('listado-ponentes__no-resultado');
                    noResultados.textContent = 'No hay resultados para tu búsqueda';

                    listadoPonentes.appendChild(noResultados);
                }

            }
            function seleccionarPonente(e) {
                const ponenteSeleccionadoAnterior = document.querySelector('.listado-ponentes__ponente--seleccionado');
                if (ponenteSeleccionadoAnterior) {
                    ponenteSeleccionadoAnterior.classList.remove('listado-ponentes__ponente--seleccionado');
                }

                const ponente = e.target;
                ponente.classList.add('listado-ponentes__ponente--seleccionado');

                inputHiddenPonenteId.value = ponente.dataset.ponenteId;
            }
        }

    }
)();