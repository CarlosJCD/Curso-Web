<?php include_once __DIR__ . "/header-dashboard.php";


if (count($proyectos) === 0) { ?>
    <p class="no-proyectos">No hay proyectos aun. <a href="/crearProyecto">Comienza creando uno</a></p>
<?php } else { ?>
    <ul class="listado-proyectos">
        <?php foreach ($proyectos as $proyecto) { ?>
            <li class="proyecto" onclick="window.location.href = '/proyecto?url=<?php echo $proyecto->url ?>'">
                <a href="/proyecto?url=<?php echo $proyecto->url ?>"><?php echo $proyecto->proyecto ?></a>
            </li>
        <?php } ?>
    </ul>
<?php } ?>



<?php include_once __DIR__ . "/footer-dashboard.php"; ?>