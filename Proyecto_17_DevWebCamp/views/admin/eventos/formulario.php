<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">
        Información Evento
    </legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre Evento</label>
        <input type="text" class="formulario__input" placeholder="Nombre Evento" id="nombre" name="nombre">
    </div>
    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripción Evento</label>
        <textarea class="formulario__input" id="descripcion" name="descripcion" placeholder="Descripción Evento" rows="8"></textarea>
    </div>

    <div class="formulario__campo">
        <label for="categoria" class="formulario__label">Categoria ó Tipo de Evento</label>
        <select id="categoria" class='formulario__select' name="categoria_id">
            <option selected disabled> - Seleccione una categoria -</option>
            <?php foreach ($categorias as $categoria) : ?>
                <option value="<?php echo $categoria->id ?>"><?php echo $categoria->nombre ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="formulario__campo">
        <label for="dia" class="formulario__label">Selecciona el dia</label>
        <div class="formulario__radio">
            <?php foreach ($dias as $dia) { ?>
                <div>
                    <label for="<?php strtolower($dia->nombre) ?>"><?php echo $dia->nombre ?></label>
                    <input type="radio" id="<?php strtolower($dia->nombre) ?>" name="dia" value="<?php $dia->id ?>">
                </div>

            <?php } ?>
        </div>

    </div>


</fieldset>