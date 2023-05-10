<?php
require '../includes/funciones.php';
añadirPlantilla('header');
?>


<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>

    <a href="propiedades/altas.php" class="boton boton-verde">Nueva propiedad</a>
    <a href="propiedades/bajas.php" class="boton boton-verde">Eliminar propiedad</a>
    <a href="propiedades/cambios.php" class="boton boton-verde">Actualizar propiedad</a>
</main>

<?php añadirPlantilla('footer'); ?>