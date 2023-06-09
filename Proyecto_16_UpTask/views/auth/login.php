<div class="contenedor login">

    <?php include_once __DIR__ . "/../templates/nombre-sitio.php" ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesion</p>
        <?php include_once __DIR__ . "/../templates/alertas.php" ?>
        <form class="formulario" method="post">
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email de la cuenta">
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password de la cuenta">
            </div>
            <input type="submit" class="boton" value="Iniciar Sesion">
        </form>
        <div class="acciones">
            <a href="/crearCuenta">No tengo una cuenta</a>
            <a href="/olvidaPassword">Olvidé mi contraseña</a>
        </div>
    </div>
</div>