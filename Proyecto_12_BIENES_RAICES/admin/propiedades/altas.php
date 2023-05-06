<?php
require '../../includes/funciones.php';
añadirPlantilla('header');
?>


<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="../index.php" class="boton boton-verde">volver</a>

    <form class="formulario">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" placeholder="Titulo Propiedad">

            <label for="precio">precio</label>
            <input type="number" id="precio" placeholder="Precio">

            <label for="imagen">precio</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripcion</label>
            <input type="textarea" id="descripcion" placeholder="Descripcion de la propiedad">
        </fieldset>
        <fieldset>
            <legend>Informacion propiedad</legend>
            <label for="habitaciones">Numero de habitaciones</label>
            <input type="number" id="habitaciones" placeholder="Num. habitaciones" min='1'>

            <label for="wc">Numero de baños</label>
            <input type="number" id="wc" placeholder="Num. baños" min='1'>

            <label for="estacionamiento">Numero de estacionamientos</label>
            <input type="number" id="estacionamiento" placeholder="Num. casillas de estacionamiento" min='1'>
        </fieldset>

        <fieldset>
            <legend>Informacion vendedor</legend>

            <label for="existentes">Seleccionar Vendedor:</label>
            <select id="existentes"></select>

            <label for="nuevo">
                Registrar vendedor nuevo:<input type="checkbox" id="nuevo" onclick="registrarNuevo(this.checked)">
            </label>
            <label for="nombre">Nombre</label>
            <input disabled class="datosVendedor" type="text" id="nombre" placeholder="Nombre vendedor">

            <label for="apellido">Apellido</label>
            <input disabled class="datosVendedor" type="text" id="apellido" placeholder="Apellido paterno">

            <label for="telefono">Numero Telefonico</label>
            <input disabled class="datosVendedor" type="tel" id="telefono" placeholder="Numo de telefono del vendedor">

        </fieldset>

        <input type="submit" value="Crear propiedad" class="boton boton-verde">

    </form>
</main>
<?php añadirPlantilla('footer'); ?>