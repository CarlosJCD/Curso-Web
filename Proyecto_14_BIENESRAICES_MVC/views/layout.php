<?php

if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION["login"] ?? false;
$inicio = $inicio ?? false;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css" />
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php">
                    <img src="/build/img/logo.svg" alt="imagen barra de navegacion" />
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="barras menu" />
                </div>
                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="boton modo oscuro" class="dark-mode-boton" />
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/anuncios">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php
                        if ($auth) { ?>
                            <a href="/cerrar-sesion.php">Cerrar Sesión</a>
                        <?php } else { ?>
                            <a href="/login.php">Iniciar Sesión</a>
                        <?php }

                        ?>
                    </nav>
                </div>
            </div>
            <?php echo $inicio ? '<h1>Venta de Casas y Departamentos de Lujo </h1>' : ''; ?>
        </div>
    </header>

    <?php echo $contenidoADesplegar ?>

    <footer class="footer seccion">
        <nav class="navegacion">
            <a href="/nosotros">Nosotros</a>
            <a href="/anuncios">Anuncios</a>
            <a href="/blog">Blog</a>
            <a href="/contacto">Contacto</a>
        </nav>
        <p class="copyright">Todos los derechos reservados 2023 &copy;</p>
    </footer>
    <script src="../build/js/bundle.min.js"></script>
</body>

</html>