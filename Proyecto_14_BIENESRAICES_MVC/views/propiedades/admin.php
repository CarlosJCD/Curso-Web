<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>
    <a href="propiedades/crear" class="boton boton-verde">Nueva propiedad</a>
    <a href="vendedores/crear" class="boton boton-amarillo">Nuevo vendedor</a>

    <?php
    if (isset($_POST["submit"])) {
        if ($_POST['tipo'] == "vendedor") { ?>
            <p class="alerta exito"> Vendedor eliminado! </p>
        <?php
        } else if ($_POST['tipo'] == "propiedad") { ?>
            <p class="alerta exito"> Propiedad eliminada! </p>
    <?php  }
    } ?>
    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td>$<?php echo $propiedad->precio; ?></td>
                    <td><img src="/imagenesPropiedades/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt="imagen propiedad"></td>
                    <td>
                        <form method="POST" class="w-100" action="propiedades/eliminar">
                            <input type="hidden" name="id" value=" <?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" name="submit" class="boton boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton boton-amarillo-block">Actualizar propiedad</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->Nombre . " " . $vendedor->Apellido; ?></td>
                    <td><?php echo $vendedor->numTelefono; ?></td>
                    <td>
                        <form method="POST" action="vendedores/eliminar">
                            <input type="hidden" name="id" value=" <?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" name="submit" class="boton boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton boton-amarillo-block">Actualizar vendedor</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>