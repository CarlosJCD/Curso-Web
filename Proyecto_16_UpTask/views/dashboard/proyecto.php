<?php include_once __DIR__ . "/header-dashboard.php"; ?>

<div class="contenedor-sm">
    <div class="contenedor-nueva-tarea">
        <button type="button" class="agregar-tarea" id='agregar-tarea'>&#43; Nueva Tarea</button>
    </div>
</div>

<ul class="listado-tareas" id="listado-tareas"></ul>

<?php include_once __DIR__ . "/footer-dashboard.php"; ?>

<?php $script = '' ?>

<script src="build/js/tareas.js"></script>