<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo</label>
    <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo filtrarHtml(obtenerParametro("titulo")) ?>">

    <label for="precio">precio</label>
    <input type="number" id="precio" name="precio" placeholder="Precio" value="<?php echo filtrarHtml(obtenerParametro("precio")) ?>">

    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

    <label for="descripcion">Descripcion</label>
    <textarea id="descripcion" name="descripcion" placeholder="Descripcion de la propiedad"><?php echo filtrarHtml(obtenerParametro("descripcion")) ?></textarea>
</fieldset>
<fieldset>
    <legend>Informacion propiedad</legend>
    <label for="habitaciones">Numero de habitaciones</label>
    <input type="number" id="habitaciones" name="habitaciones" placeholder="Num. habitaciones" min='1' value="<?php echo filtrarHtml(obtenerParametro("habitaciones")) ?>">

    <label for="wc">Numero de baños</label>
    <input type="number" id="wc" name="wc" placeholder="Num. baños" min='1' value="<?php echo filtrarHtml(obtenerParametro("wc")) ?>">

    <label for="estacionamiento">Numero de estacionamientos</label>
    <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Casillas de estacionamiento" min='1' value="<?php echo filtrarHtml(obtenerParametro("estacionamiento")) ?>">
</fieldset>

<fieldset>
    <legend>Informacion vendedor</legend>

    <label for="existentes">Seleccionar Vendedor:</label>
    <select id="existentes" name="vendedor">
        <option selected value="">-- Seleccione un vendedor --</option>
        <?php
        $query = seleccionarTodosLosVendedores($conexionDB);
        while ($vendedor = mysqli_fetch_assoc($query)) { ?>
            <option <?php
                    if (isset($_POST['vendedorExistente'])) {
                        echo $_POST['vendedorExistente'] === $vendedor['id'] ? 'selected' : '';
                    }
                    ?> value="<?php echo $vendedor['id']; ?>">
                <?php echo $vendedor['Nombre'] . " " . $vendedor['Apellido']; ?>
            </option>
        <?php
        }
        ?>
    </select>
    <label for="nuevo">
        Registrar vendedor nuevo:
        <input type="checkbox" name="vendedorNuevo" id="nuevo" onclick="registrarNuevo(this.checked)">
    </label>
    <label for="nombre">Nombre</label>
    <input disabled name="nombreNuevo" class="datosVendedor" type="text" id="nombre" placeholder="Nombre vendedor" value="<?php echo obtenerParametro("nombreNuevo") ?>">

    <label for="apellido">Apellido</label>
    <input disabled name='apellidoNuevo' class="datosVendedor" type="text" id="apellido" placeholder="Apellido paterno" value="<?php echo obtenerParametro("apellidoNuevo") ?>">

    <label for="telefono">Numero Telefonico</label>
    <input disabled name="telefonoNuevo" class="datosVendedor" type="tel" id="telefono" placeholder="Telefono del vendedor" value="<?php echo obtenerParametro("telefonoNuevo") ?>">
</fieldset>