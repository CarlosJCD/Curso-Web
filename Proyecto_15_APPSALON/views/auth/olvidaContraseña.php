<h1 class="nombre-pagina">¿Olvidaste tu contraseña?</h1>
<p class="descripcion-pagina">Reestablece tu contraseña escribiendo tu email en el siguiente campo</p>

<?php
include_once __DIR__ . "/../templates/alertas.php"

?>

<form class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu Email" name="email" />
    </div>
    <input type="submit" class="boton" value="Reestablecer contraseña">
</form>

<div class="acciones">
    <a href="/">Iniciar Sesion</a>
    <a href="/crearCuenta">Crear cuenta</a>
</div>