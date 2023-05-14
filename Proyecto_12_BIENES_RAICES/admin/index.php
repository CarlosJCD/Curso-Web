<?php

require "../includes/config/database.php";
$db = conectarDB();

$query = "SELECT * FROM propiedades";

$resultado = mysqli_query($db, $query);

require '../includes/funciones.php';
añadirPlantilla('header');
?>


<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>
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
            <?php while ($propiedad = mysqli_fetch_assoc($resultado)) : ?>
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['Titulo']; ?></td>
                    <td>$<?php echo $propiedad['precio']; ?></td>
                    <td><img src="/imagenesPropiedades/<?php echo $propiedad['imagen'] ?>" class="imagen-tabla" alt="imagen propiedad"></td>
                    <td>
                        <a href="admin/propiedades/bajas.php" class="boton boton-rojo-block">Eliminar propiedad</a>
                        <a href="admin/propiedades/cambios.php?id=<?php echo $propiedad['id']; ?>" class="boton boton-amarillo-block">Actualizar propiedad</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>
<?php mysqli_close($db); ?>

<?php añadirPlantilla('footer'); ?>