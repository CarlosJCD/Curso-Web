<div class="contenedor olvidaPassword">

    <?php include_once __DIR__ . "/../templates/nombre-sitio.php" ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Reestablecer Contraseña</p>
        <form class="formulario" method="post">
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email de la cuenta">
            </div>
            <input type="submit" class="boton" value="Reestablecer contraseña">
        </form>
        <div class="acciones">
            <a href="/">Iniciar Sesion</a>
            <a href="/crearCuenta">Crear cuenta</a>
        </div>
    </div>
</div>