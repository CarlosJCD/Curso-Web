<?php
foreach ($alertas as $tipoAlerta => $mensajes) {
    foreach ($mensajes as $mensaje) { ?>
        <div class="alerta <?php echo $tipoAlerta ?>"> <?php echo $mensaje ?></div>
<?php }
}
