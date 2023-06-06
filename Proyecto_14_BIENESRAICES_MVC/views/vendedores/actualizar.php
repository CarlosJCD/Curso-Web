<main class="contenedor seccion">
    <a href="/admin" class="boton boton-verde">Volver</a>

    <h1>Actualizar Vendedor (a)</h1>

    <?php
    if (isset($_POST['submit']) && empty($errores)) { ?>
        <p class="alerta exito"> Vendedor actualizado correctamente</p>
    <?php } ?>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST">
        <?php include "formulario.php" ?>

        <input type="submit" value="Actualizar Vendedor" name="submit" class="boton boton-verde">
    </form>

</main>