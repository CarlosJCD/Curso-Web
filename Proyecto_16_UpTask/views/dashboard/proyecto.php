<?php include_once __DIR__ . "/header-dashboard.php"; ?>

<div class="contenedor-sm">
    <div class="contenedor-nueva-tarea">
        <button type="button" class="agregar-tarea" id='agregar-tarea'>&#43; Nueva Tarea</button>
    </div>

    <div id="filtros" class="filtros">
        <div class="filtros-inputs">
            <h2>Filtros:</h2>
            <div class="campo">
                <label for="todas" class="todas">Todas</label>
                <input type="radio" id="todas" name="filtro" value="" checked>
            </div>
            <div class="campo">
                <label for="pendientes" class="pendientes">Pendientes</label>
                <input type="radio" id="pendientes" name="filtro" value="">
            </div>
            <div class="campo">
                <label for="completas" class="completas">Completas</label>
                <input type="radio" id="completas" name="filtro" value="">
            </div>
        </div>
    </div>

    <ul class="listado-tareas" id="listado-tareas"></ul>
</div>


<?php include_once __DIR__ . "/footer-dashboard.php"; ?>

<?php $script = '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="build/js/tareas.js"></script>
' ?>