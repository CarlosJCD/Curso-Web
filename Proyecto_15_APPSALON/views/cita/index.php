<h1 class="nombre-pagina">Crear Nueva Citas</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<div id="app">
    <div id="paso-1" class="seccion">
        <h2>Servicios </h2>
        <p class="text-center">Elige tus servicios a continuacion</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Tus datos y cita </h2>
        <p class="text-center">Coloca tus datos y fecha de cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input disabled type="text" id="nombre" value="<?php echo $nombre ?>">
            </div>
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha">
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time" id="hora">
            </div>

        </form>

    </div>
    <div id="paso-3" class="seccion">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la informacion sea correcta</p>

    </div>
</div>