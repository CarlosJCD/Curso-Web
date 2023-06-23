<?php include_once __DIR__ . "/header-dashboard.php"; ?>
<div class="contenedor-sm">

    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

    <form class="formulario" method="post">
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" value="<?php echo $_SESSION['nombre'] ?>">
        </div>
        <div class="campo">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Tu email" value="<?php echo $_SESSION['email'] ?>">
        </div>
        <input type="submit" value="Guardar Cambios">
    </form>
</div>
<?php include_once __DIR__ . "/footer-dashboard.php"; ?>