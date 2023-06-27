<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Personal</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input type="text" id="nombre" class="formulario__input" name="nombre" placeholder="Nombre Ponente" value="<?php echo $ponente->nombre ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label for="apellido" class="formulario__label">Apellido</label>
        <input type="text" id="apellido" class="formulario__input" name="apellido" placeholder="Apellido Ponente" value="<?php echo $ponente->apellido ?? ''; ?>">
    </div>

</fieldset>