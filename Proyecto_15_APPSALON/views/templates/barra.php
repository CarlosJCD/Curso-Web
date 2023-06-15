<div class="barra">
    <p>Hola: <?php echo $nombre ?? '' ?></p>

    <a href="/logout" class="boton">Cerrar Sesion</a>
</div>

<?php
if (isset($_SESSION['admin'])) { ?>
    <div class="barra-servicios">
        <a href="/admin" class="boton">Ver citas</a>
        <a href="/servicios" class="boton">Ver Servicios</a>
        <a href="/servicios/crear" class="boton">Servicio nuevo </a>
    </div>
<?php } ?>