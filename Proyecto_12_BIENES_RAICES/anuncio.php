<?php

require "includes/config/database.php";

$db = conectarDB();

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
  header('Location: /index.php');
}

$query = "SELECT * FROM propiedades WHERE id=$id;";

$resultado = mysqli_query($db, $query);

if (!$resultado->num_rows) {
  header("Location: /");
}

$propiedad = mysqli_fetch_assoc($resultado);

require 'includes/funciones.php';
añadirPlantilla('header');
?>
<main class="contenedor seccion contenido-centrado">
  <h1><?php echo $propiedad['Titulo'] ?></h1>

  <img loading="lazy" src="/imagenesPropiedades/<?php echo $propiedad['imagen']; ?>" alt="">


  <div class="resumen-propiedad">
    <p class="precio">$<?php echo $propiedad['precio']; ?></p>
    <ul class="iconos-caracteristicas">
      <li>
        <img class="icono" loading="lazy" src="/build/img/icono_wc.svg" alt="icono wc" />
        <p><?php echo $propiedad['wc']; ?></p>
      </li>
      <li>
        <img class="icono" loading="lazy" src="/build/img/icono_estacionamiento.svg" alt="icono estacionamiento" />
        <p><?php echo $propiedad['estacionamientos']; ?></p>
      </li>
      <li>
        <img class="icono" loading="lazy" src="/build/img/icono_dormitorio.svg" alt="icono habitaciones" />
        <p><?php echo $propiedad['habitaciones']; ?></p>
      </li>
    </ul>
    <p><?php echo $propiedad['descripcion']; ?></p>
  </div>
</main>

<?php añadirPlantilla('footer');

mysqli_close($db);
?>