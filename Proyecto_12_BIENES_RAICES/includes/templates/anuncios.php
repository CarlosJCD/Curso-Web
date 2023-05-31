<?php

$db = conectarDB();

$query = "SELECT * FROM propiedades LIMIT $limite;";

$resultado = mysqli_query($db, $query);

?>


<div class="contenedor-anuncios">
    <?php while ($propiedad = mysqli_fetch_assoc($resultado)) : ?>
        <div class="anuncio">
            <img loading="lazy" src="/imagenesPropiedades/<?php echo $propiedad['imagen']; ?>" alt="">
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad['Titulo']; ?></h3>
                <p>
                    <?php echo $propiedad['descripcion']; ?>
                </p>
                <p class="precio">$<?php echo $propiedad['precio']; ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img loading="lazy" src="/build/img/icono_wc.svg" alt="icono wc anuncio1" />
                        <p><?php echo $propiedad['wc']; ?></p>
                    </li>
                    <li>
                        <img loading="lazy" src="/build/img/icono_estacionamiento.svg" alt="icono estacionamiento anuncio1" />
                        <p><?php echo $propiedad['estacionamientos']; ?></p>
                    </li>
                    <li>
                        <img loading="lazy" src="/build/img/icono_dormitorio.svg" alt="icono dormitorios anuncio1" />
                        <p><?php echo $propiedad['habitaciones']; ?></p>
                    </li>
                </ul>
                <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
                    Ver propiedad
                </a>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<?php
mysqli_close($db);
?>