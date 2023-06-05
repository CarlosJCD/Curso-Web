<?php

require "../../includes/app.php";

validarAcceso();

use App\Vendedor;


$errores = Vendedor::getErrores();
$vendedor = new Vendedor($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vendedor = new Vendedor($_POST["vendedor"]);
    $errores = $vendedor->validar();


    if (empty($errores)) {
        $vendedor->registrar();
    }
}

añadirPlantilla('header');

?>


<main class="contenedor seccion">
    <h1>Registrar Vendedor (a)</h1>

    <?php
    if (isset($_POST['submit']) && empty($errores)) { ?>
        <p class="alerta exito"> Vendedor registrado correctamente</p>
    <?php
        $vendedor = new Vendedor;
    }
    ?>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/vendedores/altas.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Registrar Vendedor" name="submit" class="boton boton-verde">
    </form>

</main>
<?php añadirPlantilla('footer'); ?>