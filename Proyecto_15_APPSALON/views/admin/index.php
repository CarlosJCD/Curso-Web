<h1 class="nombre-pagina">Panel administracion</h1>

<?php include_once __DIR__ . "/../templates/barra.php" ?>

<h2>Buscar Citas</h2>
<div class="busqueda">
    <form>
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha">
        </div>
    </form>
</div>

<div class="citas-admin"></div>