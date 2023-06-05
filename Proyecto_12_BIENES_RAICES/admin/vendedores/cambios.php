<?php

require "../../includes/app.php";

validarAcceso();

use App\Vendedor;

$id = $_GET['id'];

$id = filter_var($id, FILTER_VALIDATE_INT);


if (!$id) {
    header('Location: /admin');
}

$vendedor = Vendedor::findById($id);
$errores = Vendedor::getErrores();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $args = $_POST["vendedor"];
    $vendedor->sincronizar($args);
    $errores = $vendedor->validar();

    if (empty($errores)) {

        $vendedor->actualizar();
    }
}

añadirPlantilla('header');

?>


<main class="contenedor seccion">
    <h1>Actualizar Vendedor (a)</h1>

    <?php
    if (isset($_POST['submit']) && empty($errores)) { ?>
        <p class="alerta exito"> Vendedor actualizado correctamente</p>
    <?php
    }
    ?>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Actualizar Vendedor" name="submit" class="boton boton-verde">
    </form>

</main>
<?php añadirPlantilla('footer'); ?>