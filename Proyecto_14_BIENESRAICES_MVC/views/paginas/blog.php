<main class="contenedor seccion contenido-centrado">
    <h1>Nuestro Blog</h1>
    <?php
    foreach ($entradasBlog as $entradaBlog) {
    ?>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <img loading="lazy" src="/imagenesEntradas/<?php echo $entradaBlog->imagen ?>" alt="Texto Entrada Blog" />
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada?id=<?php echo $entradaBlog->id ?>">
                    <h4><?php echo $entradaBlog->titulo ?></h4>
                    <p>Escrito el: <span><?php echo $entradaBlog->fechaCreacion ?> </span> por: <span><?php echo $entradaBlog->autor ?></span></p>

                    <p>
                        <?php echo $entradaBlog->sinopsis ?>
                    </p>
                </a>
            </div>
        </article>
    <?php } ?>
</main>