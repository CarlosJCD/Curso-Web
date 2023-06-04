<?php

require "../../includes/app.php";

validarAcceso();

use App\Vendedor;

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

$vendedor = Vendedor::findById($id);

$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}

añadirPlantilla('header');

?>


<main class="contenedor seccion">
    <h1>Actualizar Vendedor (a)</h1>



    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/vendedores/cambios.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
    </form>

</main>
<?php añadirPlantilla('footer'); ?>