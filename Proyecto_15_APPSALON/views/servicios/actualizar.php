<h1 class="nombre-pagin">Actualizar Servicios</h1>
<?php
include_once __DIR__ . "/../templates/barra.php";
?>
<p class="descripcion-pagina">Modifica los valores que desees cambiar del servicio.</p>

<form method="POST" class="formulario">
    <?php include_once __DIR__ . "/formulario.php"; ?>
    <input type="submit" class="boton" value="Actualizar Servicio">
</form>