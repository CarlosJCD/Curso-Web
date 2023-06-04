<?php

require "../../includes/app.php";

validarAcceso();

use App\Vendedor;

$vendedor = new Vendedor();

$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}

añadirPlantilla('header');

?>


<main class="contenedor seccion">
    <h1>Registrar Vendedor (a)</h1>



    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/vendedores/crear.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
    </form>

</main>
<?php añadirPlantilla('footer'); ?>