<h1 class="nombre-pagina">Cambiar contraseña</h1>
<p class="descripcion-pagina">Coloca tu nueva password a continuacion</p>
<?php
include_once __DIR__ . "/../templates/alertas.php";

if ($usuario) { ?>
    <form method="POST" class="formulario">
        <div class="campo">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Tu nueva contraseña">
        </div>
        <?php
        if ($usuario) { ?>
            <input type="submit" class="boton" value="Guardar contraseña nueva">
        <?php }
        ?>
    </form>
<?php }

?>


<div class="acciones">
    <a href="/">Iniciar sesion</a>
    <a href="/olvidaContraseña">Olvidé mi contraseña</a>
</div>