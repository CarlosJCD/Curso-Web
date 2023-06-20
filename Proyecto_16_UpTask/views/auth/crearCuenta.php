<div class="contenedor crear">

    <?php include_once __DIR__ . "/../templates/nombre-sitio.php" ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta</p>

        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <form class="formulario" method="post">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="nombre" id="nombre" name="cuenta[nombre]" placeholder="Nombre Completo" value="<?php echo s($usuario->nombre) ?>">
            </div>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" name="cuenta[email]" placeholder="Escoge un email" value="<?php echo s($usuario->email) ?>">
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" name="cuenta[password]" placeholder="Ingresa tu contraseña">
            </div>
            <div class="campo">
                <label for="password">Confirma tu contraseña</label>
                <input type="password" id="password" name="confirmarPassword" placeholder="Confirma tu contraseña">
            </div>
            <input type="submit" class="boton" value="Crear cuenta">
        </form>
        <div class="acciones">
            <a href="/">Ya tengo una cuenta</a>
            <a href="/olvidaPassword">Olvidé mi contraseña</a>
        </div>
    </div>


</div>