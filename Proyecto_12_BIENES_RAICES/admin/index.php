<?php


$mensaje = $_GET['resultado'] ?? 0;



require '../includes/funciones.php';
añadirPlantilla('header');
?>


<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>
    <?php
    if ($mensaje == 1) { ?>
        <p class="alerta exito"> Anuncio creado correctamente</p>
    <?php }
    ?>
    <a href="/admin/propiedades/altas.php" class="boton boton-verde">Nueva propiedad</a>


    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Casa en la playa</td>
                <td>$910290132</td>
                <td><img src="../imagenesPropiedades/037a7f9f05dc5f3897f82e0d30ec8d9d.jpg" class="imagen-tabla"></td>
                <td>
                    <a href="admin/propiedades/bajas.php" class="boton boton-verde">Eliminar propiedad</a>
                    <a href="admin/propiedades/cambios.php" class="boton boton-verde">Actualizar propiedad</a>
                </td>
            </tr>
        </tbody>
    </table>
</main>

<?php añadirPlantilla('footer'); ?>