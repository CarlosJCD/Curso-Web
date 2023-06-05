<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo filtrarHtml($propiedad->titulo) ?>">

    <label for="precio">precio</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio" value="<?php echo filtrarHtml($propiedad->precio) ?>">

    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">

    <?php
    if (isset($_POST['imagen'])) { ?>
        <img src="/imagenesPropiedades/<?php echo $_POST['imagen'] ?>" class="imagen-preview">
    <?php } ?>

    <label for="descripcion">Descripcion</label>
    <textarea id="descripcion" name="propiedad[descripcion]" placeholder="Descripcion de la propiedad"><?php echo filtrarHtml($propiedad->descripcion) ?></textarea>
</fieldset>
<fieldset>
    <legend>Informacion propiedad</legend>
    <label for="habitaciones">Numero de habitaciones</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Num. habitaciones" min='1' value="<?php echo filtrarHtml($propiedad->habitaciones) ?>">

    <label for="wc">Numero de baños</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Num. baños" min='1' value="<?php echo filtrarHtml($propiedad->wc) ?>">

    <label for="estacionamiento">Numero de estacionamientos</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Casillas de estacionamiento" min='1' value="<?php echo filtrarHtml($propiedad->estacionamiento) ?>">
</fieldset>

<fieldset>
    <legend>Informacion vendedor</legend>

    <label for="vendedor">Seleccionar Vendedor:</label>
    <select id="vendedor" name="propiedad[idVendedor]">
        <option selected disabled value="">-- Seleccione un vendedor --</option>
        <?php
        foreach ($vendedores as $vendedor) { ?>
            <option <?php
                    if ($propiedad->idVendedor) {
                        echo $propiedad->idVendedor === $vendedor->id ? 'selected' : '';
                    }
                    ?> value="<?php echo $vendedor->id; ?>">
                <?php echo $vendedor->Nombre . " " . $vendedor->Apellido; ?>
            </option>
        <?php } ?>
    </select>
</fieldset>