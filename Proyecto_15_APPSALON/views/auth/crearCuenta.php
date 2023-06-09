<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Ingrese los siguientes datos para crear una cuenta nueva</p>

<form action="/crearCuenta" class="formulario" method="POST">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" placeholder="Tu nombre" name="nombre" value="<?php echo $usuario->nombre ?>" />
    </div>

    <div class="campo">
        <label for="apellido">Apellido Paterno</label>
        <input type="text" id="apellido" placeholder="Tu apellido" name="apellido" value="<?php echo $usuario->apellido ?>" />
    </div>

    <div class="campo">
        <label for="telefono">Telefono</label>
        <input type="tel" id="telefono" placeholder="Tu telefono" name="telefono" value="<?php echo $usuario->telefono ?>" />
    </div>
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu Email" name="email" value="<?php echo $usuario->email ?>" />
    </div>
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="Tu contraseña" name="password" />
    </div>
    <input type="submit" class="boton" value="Crear cuenta">
</form>

<div class="acciones">
    <a href="/">Iniciar Sesion</a>
    <a href="/olvidaContraseña">Olvidé mi contraseña</a>
</div>