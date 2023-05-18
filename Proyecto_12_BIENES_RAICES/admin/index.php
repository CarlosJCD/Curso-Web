<?php

require "../includes/config/database.php";
$db = conectarDB();

$query = "SELECT * FROM propiedades";

$resultado = mysqli_query($db, $query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id) {

        $queryImagen = "SELECT imagen FROM propiedades WHERE id = $id";
        $resultadoImagen = mysqli_query($db, $queryImagen);
        $rutaImagen = mysqli_fetch_assoc($resultadoImagen);
        if ($rutaImagen) {
            unlink("../imagenesPropiedades/" . $rutaImagen['imagen']);
        }

        $query = "DELETE FROM propiedades WHERE id = $id";
        $resultadoEliminar = mysqli_query($db, $query);
        if ($resultadoEliminar) {
            header('Location: /');
        }
    }
}

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
                        <form method="POST">
                            <input type="hidden" name="id" value=" <?php echo $propiedad['id']; ?>">
                            <input type="submit" class="boton boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="/admin/propiedades/cambios.php?id=<?php echo $propiedad['id']; ?>" class="boton boton-amarillo-block">Actualizar propiedad</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>
<?php mysqli_close($db); ?>

<?php añadirPlantilla('footer'); ?>