<h2 class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/eventos/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Evento
    </a>
</div>

<div class="dashboard__contenedor">
    <?php if (!empty($eventos)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Evento</th>
                    <th scope="col" class="table__th">Categoria</th>
                    <th scope="col" class="table__th">Dia y Hora</th>
                    <th scope="col" class="table__th">Ponente</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($eventos as $evento) {  ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $evento->nombre; ?>
                        </td>

                        <td class="table__td">
                            <?php echo $evento->categoria_id; ?>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>


    <?php } else { ?>
        <p class="text-center">No Hay Ponentes Aún.</p>

    <?php } ?>
</div>