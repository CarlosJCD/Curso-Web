<fieldset>
    <legend> Informacion Vendedor</legend>

    <label for="nombre">Nombre</label>
    <input name="vendedor[Nombre]" class="datosVendedor" type="text" id="nombre" placeholder="Nombre vendedor(a)" value="<?php echo filtrarHtml($vendedor->Nombre); ?>">

    <label for="apellido">Apellido</label>
    <input name='vendedor[Apellido]' class="datosVendedor" type="text" id="apellido" placeholder="Apellido vendedor(a)" value="<?php echo filtrarHtml($vendedor->Apellido); ?>">

</fieldset>
<fieldset>
    <legend> Informacion Extra</legend>

    <label for="telefono">Numero Telefonico</label>
    <input name="vendedor[numTelefono]" class="datosVendedor" type="tel" id="telefono" placeholder="Telefono vendedor(a)" value="<?php echo filtrarHtml($vendedor->numTelefono); ?>">
</fieldset>