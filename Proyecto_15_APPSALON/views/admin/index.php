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

<div class="citas-admin">
    <ul class="citas">
        <?php
        $idCita = "";
        foreach ($citas as $cita) { ?>
            <li>
                <?php
                if ($idCita != $cita->id) {
                    $idCita = $cita->id; ?>
                    <hr>
                    <p>ID: <span><?php echo $cita->id ?></span></p>
                    <p>Hora: <span><?php echo $cita->hora ?></span></p>
                    <p>Cliente: <span><?php echo $cita->cliente ?></span></p>
                    <p>Email: <span><?php echo $cita->email ?></span></p>
                    <p>Telefono: <span><?php echo $cita->telefono ?></span></p>

                    <h2>Servicios</h2>
                <?php } ?>
                <p class="servicio"><?php echo $cita->servicio . " " . $cita->precio; ?></p>
            </li>
        <?php } ?>
    </ul>
</div>