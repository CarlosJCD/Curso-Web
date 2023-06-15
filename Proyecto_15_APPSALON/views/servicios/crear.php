<h1 class="nombre-pagin">Nuevo Servicio</h1>
<?php
include_once __DIR__ . "/../templates/barra.php";
include_once __DIR__ . "/../templates/alertas.php";
?>
<p class="descripcion-pagina">Llena los siguientes campos para registrar un nuevo servicio.</p>

<form action="/servicios/crear" method="POST" class="formulario">
    <?php
    include_once __DIR__ . "/formulario.php" ?>
    <input type="submit" class="boton" value="Registrar Servicio">
</form>