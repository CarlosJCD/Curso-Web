(function () {
    const registroResumenDiv = document.querySelector('#registro-resumen');
    if (registroResumenDiv) {
        let eventos = [];
        const eventosBoton = document.querySelectorAll(".evento__agregar");
        eventosBoton.forEach(boton => boton.onclick = seleccionarEvento);

        function seleccionarEvento(e) {
            eventos = [...eventos, {
                id: e.target.dataset.id,
                titulo: e.target.parentElement.querySelector('.evento__nombre').textContent.trim()
            }]
            e.target.disabled = true
            console.log(eventos);
        }
    }

})();