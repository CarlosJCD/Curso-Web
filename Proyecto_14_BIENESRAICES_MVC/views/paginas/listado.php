<div class="contenedor-anuncios">
    <?php foreach ($propiedades as $propiedad) : ?>
        <div class="anuncio">
            <img loading="lazy" src="/imagenesPropiedades/<?php echo $propiedad->imagen; ?>" alt="">
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p>
                    <?php echo $propiedad->descripcion; ?>
                </p>
                <p class="precio">$<?php echo $propiedad->precio; ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img loading="lazy" src="/build/img/icono_wc.svg" alt="icono wc anuncio1" />
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img loading="lazy" src="/build/img/icono_estacionamiento.svg" alt="icono estacionamiento anuncio1" />
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>
                    <li>
                        <img loading="lazy" src="/build/img/icono_dormitorio.svg" alt="icono dormitorios anuncio1" />
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                </ul>
                <a href="anuncio?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">
                    Ver propiedad
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>