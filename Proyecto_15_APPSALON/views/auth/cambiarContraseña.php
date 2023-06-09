<h1 class="nombre-pagina">Cambiar contraseña</h1>
<p class="descripcion-pagina">Coloca tu nueva password a continuacion</p>
<?php include_once __DIR__ . "/../templates/alertas.php" ?>

<form method="POST" class="formulario">
    <div class="campo">
        <label for="email">Email:</label>
        <input disabled type="email" id="email" value="<?php echo $usuario->email ?>">
    </div>

    <div class="campo">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Tu nueva contraseña">
    </div>
    <input type="submit" class="boton" value="Guardar contraseña nueva">
</form>

<div class="acciones">
    <a href="/">Iniciar sesion</a>
    <a href="/olvidaContraseña">Olvidé mi contraseña</a>
</div>