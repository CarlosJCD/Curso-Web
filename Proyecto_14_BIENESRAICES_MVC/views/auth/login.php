<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error"><?php echo $error; ?></div>
    <?php endforeach; ?>
    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Tu email">

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Tu contraseña">

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </fieldset>
    </form>

</main>