<main class="contenedor seccion contenido-centrado">

    <h1><?php echo $entradaBlog->titulo ?></h1>

    <picture>
        <img loading="lazy" src="/imagenesEntradas/<?php echo $entradaBlog->imagen ?>" alt="Texto Entrada Blog" />
    </picture>

    <p class="informacion-meta">
        Escrito el: <span><?php echo $entradaBlog->fechaCreacion ?> </span> por: <span><?php echo $entradaBlog->autor ?></span>
    </p>

    <div class="resumen-propiedad">
        <?php echo $entradaBlog->procesarParrafos() ?>

    </div>
</main>