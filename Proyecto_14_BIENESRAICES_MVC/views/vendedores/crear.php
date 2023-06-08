<main class="contenedor seccion">
    <h1>Registrar Vendedor (a)</h1>

    <?php

    use Model\Vendedor;

    if (isset($_POST['submit']) && empty($errores)) { ?>
        <p class="alerta exito"> Vendedor registrado correctamente</p>
    <?php
        $vendedor = new Vendedor();
    }
    ?>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/vendedores/crear">
        <?php include "formulario.php" ?>

        <input type="submit" value="Registrar Vendedor" name="submit" class="boton boton-verde">
    </form>

</main>