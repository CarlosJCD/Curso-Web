<?php

require "../includes/app.php";

validarAcceso();

use App\Propiedad;
use App\Vendedor;

$propiedades = Propiedad::all();
$vendedores = Vendedor::all();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($_POST["tipo"] === "propiedad") {
        $propiedad = Propiedad::findById($id);
        $propiedad->eliminar();
    } else {
        $vendedor = Vendedor::findById($id);
        $vendedor->eliminar();
    }
    header("Location: /admin");
}

añadirPlantilla('header');
?>


<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>
    <a href="/admin/propiedades/altas.php" class="boton boton-verde">Nueva propiedad</a>
    <a href="/admin/vendedores/altas.php" class="boton boton-amarillo">Nuevo vendedor</a>

    <h2>Propiedades</h2>

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
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="/admin/propiedades/cambios.php?id=<?php echo $propiedad->id; ?>" class="boton boton-amarillo-block">Actualizar propiedad</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->Nombre . " " . $vendedor->Apellido; ?></td>
                    <td><?php echo $vendedor->numTelefono; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value=" <?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="/admin/vendedores/cambios.php?id=<?php echo $vendedor->id; ?>" class="boton boton-amarillo-block">Actualizar vendedor</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php añadirPlantilla('footer'); ?>