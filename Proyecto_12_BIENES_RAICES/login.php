<?php
require 'includes/funciones.php';
añadirPlantilla('header');
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <form class="formulario">
        <fieldset>
            <legend>Email y Password</legend>
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Tu email">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Tu contraseña">
            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </fieldset>
    </form>

</main>

<?php añadirPlantilla('footer'); ?>