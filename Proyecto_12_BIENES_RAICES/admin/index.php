<?php

require "../includes/app.php";

validarAcceso();

use App\Propiedad;

$propiedades = Propiedad::all();


$db = conectarDB();

$query = "SELECT * FROM propiedades";

$resultado = mysqli_query($db, $query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    $propiedad = Propiedad::findById($id);

    $propiedad->eliminar();
}

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
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td>$<?php echo $propiedad->precio; ?></td>
                    <td><img src="/imagenesPropiedades/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt="imagen propiedad"></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value=" <?php echo $propiedad->id; ?>">
                            <input type="submit" class="boton boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="/admin/propiedades/cambios.php?id=<?php echo $propiedad->id; ?>" class="boton boton-amarillo-block">Actualizar propiedad</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php mysqli_close($db); ?>

<?php añadirPlantilla('footer'); ?>