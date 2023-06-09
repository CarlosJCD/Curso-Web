<h1 class="nombre-pagina">Panel administracion</h1>

<?php include_once __DIR__ . "/../templates/barra.php" ?>
<?php
function impimirDatosCita($cita)
{
    echo "
    <li>
    <p>ID: <span>$cita->id</span></p>
    <p>Hora: <span> $cita->hora</span></p>
    <p>Cliente: <span> $cita->cliente</span></p>
    <p>Email: <span> $cita->email</span></p>
    <p>Telefono: <span> $cita->telefono</span></p>
    <h2>Servicios</h2>
    ";
}

function finDeCita($totalCita, $citaId)
{
    echo "
    <p class='total'>Total: <span>$totalCita</span></p>
    <form action='/api/eliminar' method='POST'>
        <input type='hidden' name='id' value='$citaId'>
        <input type='submit' class='boton-eliminar' value='Eliminar Cita'>
    </form>
    ";
}

?>
<h2>Buscar Citas</h2>
<div class="busqueda">
    <form>
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha ?>">
        </div>
    </form>
</div>

<div class="citas-admin">
    <ul class="citas">
        <?php
        if ($citas) {
            $idCita = "";
            $totalCita = 0;
            foreach ($citas as $key => $cita) { ?>
                <?php
                if ($idCita != $cita->id) {
                    if ($totalCita != 0) finDeCita($totalCita, $idCita);
                    $idCita = $cita->id;
                    $totalCita = 0;
                    impimirDatosCita($cita);
                }
                ?>
                <p class="servicio"><?php echo $cita->servicio . " " . $cita->precio; ?></p>
                <?php $totalCita += $cita->precio ?>
        <?php }
            finDeCita($totalCita, $idCita);
        } else {
            echo "<h2>No hay citas registradas en esta fecha</h2>";
        }
        ?>
    </ul>


</div>
<?php


$script = "<script src='build/js/buscador.js'></script>"

?>