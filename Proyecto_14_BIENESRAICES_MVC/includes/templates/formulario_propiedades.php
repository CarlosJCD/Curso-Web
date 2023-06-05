<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo</label>
    <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo filtrarHtml(obtenerParametro("titulo")) ?>">

    <label for="precio">precio</label>
    <input type="number" id="precio" name="precio" placeholder="Precio" value="<?php echo filtrarHtml(obtenerParametro("precio")) ?>">

    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

    <?php
    if (isset($_POST['imagen'])) { ?>
        <img src="/imagenesPropiedades/<?php echo $_POST['imagen'] ?>" class="imagen-preview">
    <?php } ?>

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
        <option selected disabled value="">-- Seleccione un vendedor --</option>
        <?php
        foreach ($vendedores as $vendedor) { ?>
            <option <?php
                    if (isset($_POST['vendedor']) && $_POST['vendedor'] != "") {
                        echo $_POST['vendedor'] === $vendedor->id ? 'selected' : '';
                    }
                    ?> value="<?php echo $vendedor->id; ?>">
                <?php echo $vendedor->Nombre . " " . $vendedor->Apellido; ?>
            </option>
        <?php } ?>
    </select>
</fieldset>