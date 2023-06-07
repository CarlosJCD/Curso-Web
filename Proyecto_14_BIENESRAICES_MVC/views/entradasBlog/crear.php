<main class="contenedor seccion">
    <a href="/admin" class="boton boton-verde">Volver</a>
    <h1>Crear Entrada de Blog</h1>
    <?php

    use Model\EntradaBlog;

    if (isset($_POST['submit']) && empty($errores)) { ?>
        <p class="alerta exito"> Entrada registrada correctamente</p>
    <?php
        $entradaBlog = new EntradaBlog();
    } ?>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . "/formulario.php" ?>

        <input type="submit" name="submit" class="boton boton-verde">

    </form>
</main>