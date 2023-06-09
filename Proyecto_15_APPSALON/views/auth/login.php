<h1 class="nombre-pagina">Iniciar Sesion</h1>
<p class="descripcion-pagina">Inicia sesion con tus datos</p>

<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu Email" name="email" />
    </div>
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="Tu contraseña" name="password" />
    </div>
    <input type="submit" class="boton" value="Iniciar Sesion">
</form>

<div class="acciones">
    <a href="/crearCuenta">Crear cuenta</a>
    <a href="/olvidaContraseña">Olvide mi contraseña</a>
</div>