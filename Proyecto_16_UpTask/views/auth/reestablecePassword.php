<div class="contenedor restablece">

    <?php include_once __DIR__ . "/../templates/nombre-sitio.php" ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nuevo password</p>
        <form class="formulario" method="post">
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Nuevo Password">
            </div>
            <input type="submit" class="boton" value="Guardar password">
        </form>
        <div class="acciones">
            <a href="/">Iniciar Sesion</a>
            <a href="/crearCuenta">Crear cuenta</a>
        </div>
    </div>
</div>