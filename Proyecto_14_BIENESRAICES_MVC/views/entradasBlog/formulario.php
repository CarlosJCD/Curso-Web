<fieldset>

    <legend>Informacion General</legend>

    <label for="titulo">Titulo</label>
    <input type="text" id="titulo" name="entrada[titulo]" placeholder="Titulo Propiedad" value="<?php echo filtrarHtml($entradaBlog->titulo) ?>">

    <label for="sinopsis">Sinopsis</label>
    <input type="text" id="sinopsis" name="entrada[sinopsis]" placeholder="Sinopsis de la Entrada" value="<?php echo filtrarHtml($entradaBlog->sinopsis) ?>">

    <label for="autor">Autor</label>
    <input type="text" id="autor" name="entrada[autor]" placeholder="Autor de la entrada" value="<?php echo filtrarHtml($entradaBlog->autor) ?>">



</fieldset>
<fieldset>
    <legend>Contenido entrada</legend>
    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" name="entrada[imagen]" accept="image/jpeg, image/png">

    <?php
    if (isset($entradaBlog->imagen) && $entradaBlog->imagen != "") { ?>
        <img src="/imagenesEntradas/<?php echo $entradaBlog->imagen ?>" class="imagen-preview"><br>
    <?php } ?>

    <label for="resumen">Texto</label>
    <textarea id="resumen" name="entrada[resumen]" placeholder="Aqui va el contenido de la entrada (Una linea en blanco entre cada parrafo)"><?php echo filtrarHtml($entradaBlog->resumen) ?></textarea>
</fieldset>