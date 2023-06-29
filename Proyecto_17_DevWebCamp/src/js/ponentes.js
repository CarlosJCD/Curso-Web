(
    function () {
        const ponentesInput = document.querySelector('#ponentes');

        if (ponentesInput) {
            let ponentes = [];
            let ponentesFiltrados = [];

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
                if (busqueda.length >= 1) {
                    const expresion = new RegExp(busqueda, 'i');
                    ponentesFiltrados = ponentes.filter(ponente => {
                        if (ponente.nombre.toLowerCase().search(expresion) != -1) {
                            return ponente;
                        }
                    });
                    console.log(ponentesFiltrados);
                }
            }
        }

    }
)();