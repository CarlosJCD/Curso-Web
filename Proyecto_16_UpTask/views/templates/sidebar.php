<aside class="sidebar">
    <div class="contenedor-sidebar">
        <h2>UpTask</h2>

        <div class="cerrar-menu">
            <img id='cerrar-menu' src="build/img/cerrar.svg" alt="imagen cerrar menu mobile">
        </div>
    </div>
    <nav class="sidebar-nav">
        <a <?php echo ($titulo == 'Proyectos') ? 'class = "activo"' : ''; ?> href="/dashboard">Proyectos</a>
        <a <?php echo ($titulo == 'Crear proyecto') ? 'class = "activo"' : ''; ?> href="/crearProyecto">Crear proyecto</a>
        <a <?php echo ($titulo == 'Perfil') ? 'class = "activo"' : ''; ?> href="/perfil">Perfil</a>
    </nav>
</aside>