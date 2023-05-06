<?php
require 'includes/funciones.php';
añadirPlantilla('header', $inicio = true);
?>


<main class="contenedor seccion">
  <h1>Mas sobre nosotros</h1>
  <div class="iconos-nosotros">
    <div class="icono">
      <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy" />
      <h3>seguridad</h3>
      <p>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illo
        voluptatum porro quod soluta harum nostrum commodi maxime.
        Voluptatibus, obcaecati ipsa. Labore soluta officia rem quasi
        necessitatibus sequi sed, molestias odio!
      </p>
    </div>

    <div class="icono">
      <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy" />
      <h3>Precio</h3>
      <p>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illo
        voluptatum porro quod soluta harum nostrum commodi maxime.
        Voluptatibus, obcaecati ipsa. Labore soluta officia rem quasi
        necessitatibus sequi sed, molestias odio!
      </p>
    </div>

    <div class="icono">
      <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy" />
      <h3>Tiempo</h3>
      <p>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illo
        voluptatum porro quod soluta harum nostrum commodi maxime.
        Voluptatibus, obcaecati ipsa. Labore soluta officia rem quasi
        necessitatibus sequi sed, molestias odio!
      </p>
    </div>
  </div>
</main>

<section class="seccion contenedor">
  <h2>Casas y Departamentos en Venta</h2>
  <div class="contenedor-anuncios">
    <div class="anuncio">
      <picture>
        <source srcset="build/img/anuncio1.webp" type="image/webp" />
        <source srcset="build/img/anuncio1.jpg" type="image/jpeg" />
        <img loading="lazy" src="build/img/anuncio1.jpg" alt="Anuncio 1" />
      </picture>
      <div class="contenido-anuncio">
        <h3>Casa de lujo en el lago</h3>
        <p>
          Casa en el lago con excelente vista, acabados de lujo a un precio
          excelente
        </p>
        <p class="precio">$3,000,000</p>
        <ul class="iconos-caracteristicas">
          <li>
            <img loading="lazy" src="build/img/icono_wc.svg" alt="icono wc anuncio1" />
            <p>3</p>
          </li>
          <li>
            <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento anuncio1" />
            <p>3</p>
          </li>
          <li>
            <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorios anuncio1" />
            <p>4</p>
          </li>
        </ul>
        <a href="anuncios.php" class="boton-amarillo-block">
          Ver propiedad
        </a>
      </div>
    </div>
    <div class="anuncio">
      <picture>
        <source srcset="build/img/anuncio2.webp" type="image/webp" />
        <source srcset="build/img/anuncio2.jpg" type="image/jpeg" />
        <img loading="lazy" src="build/img/anuncio2.jpg" alt="Anuncio 1" />
      </picture>
      <div class="contenido-anuncio">
        <h3>Casa de lujo</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <p class="precio">$3,000,000</p>
        <ul class="iconos-caracteristicas">
          <li>
            <img loading="lazy" src="build/img/icono_wc.svg" alt="icono wc anuncio1" />
            <p>3</p>
          </li>
          <li>
            <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento anuncio1" />
            <p>3</p>
          </li>
          <li>
            <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorios anuncio1" />
            <p>4</p>
          </li>
        </ul>
        <a href="anuncios.php" class="boton-amarillo-block">
          Ver propiedad
        </a>
      </div>
    </div>
    <div class="anuncio">
      <picture>
        <source srcset="build/img/anuncio3.webp" type="image/webp" />
        <source srcset="build/img/anuncio3.jpg" type="image/jpeg" />
        <img loading="lazy" src="build/img/anuncio3.jpg" alt="Anuncio 2" />
      </picture>
      <div class="contenido-anuncio">
        <h3>Casa con alberc</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

        <p class="precio">$3,000,000</p>
        <ul class="iconos-caracteristicas">
          <li>
            <img loading="lazy" src="build/img/icono_wc.svg" alt="icono wc anuncio1" />
            <p>3</p>
          </li>
          <li>
            <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento anuncio1" />
            <p>3</p>
          </li>
          <li>
            <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorios anuncio1" />
            <p>4</p>
          </li>
        </ul>
        <a href="anuncios.php" class="boton-amarillo-block">
          Ver propiedad
        </a>
      </div>
    </div>
  </div>
  <div class="alinear-derecha">
    <a href="anuncios.php" class="boton boton-verde">Ver todas</a>
  </div>
</section>

<section class="imagen-contacto">
  <h2>Encuentra la casa de tus sueños</h2>
  <p>
    Llena el formulario de contacto y un asesor se pondra en contacto
    contigo.
  </p>
  <a href="contacto.php" class="boton-amarillo">Contactanos</a>
</section>

<div class="contenedor secccion seccion-inferior">
  <section class="blog">
    <h3>Nuestro blog</h3>
    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="build/img/blog1.webp" type="image/webp" />
          <source srcset="build/img/blog1.jpg" type="image/jpeg" />
          <img src="build/img/blog1.jpg" alt="Entrada blog" />
        </picture>
      </div>

      <div class="texto-entrada informacion-meta">
        <a href="entrada.php">
          <h4>Terraza en el techo de tu casa</h4>
          <p>Escrito el: <span>20/10/2023</span> por <span>admin</span></p>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit</p>
        </a>
      </div>
    </article>
    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="build/img/blog2.webp" type="image/webp" />
          <source srcset="build/img/blog2.jpg" type="image/jpeg" />
          <img src="build/img/blog2.jpg" alt="Entrada blog" />
        </picture>
      </div>

      <div class="texto-entrada informacion-meta">
        <a href="entrada.php">
          <h4>Guia para la decoracion</h4>
          <p>Escrito el: <span>08/05/2023</span> por <span>admin</span></p>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit</p>
        </a>
      </div>
    </article>
  </section>
  <section class="testimoniales">
    <h3>Testimoniales</h3>
    <div class="testimonial">
      <blockquote>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus
        inventore quae molestias iusto. Illo voluptates atque, magnam sed
        fugit vero maxime laudantium ex ad saepe. Vitae accusantium rerum
        debitis sequi!
      </blockquote>
      <p>Lorem I.</p>
    </div>
  </section>
</div>

<?php añadirPlantilla('footer'); ?>