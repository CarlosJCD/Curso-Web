<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace <?php echo enlace_actual('/dashboard') ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>
        </a>

        <a href="/admin/ponentes" class="dashboard__enlace <?php echo enlace_actual('/ponentes') ?>">
            <i class="fa-solid fa-user-tie dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Ponentes
            </span>
        </a>

        <a href="/admin/eventos" class="dashboard__enlace <?php echo enlace_actual('/eventos') ?>">
            <i class="fa-regular fa-calendar-days dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Eventos
            </span>
        </a>

        <a href="/admin/registrados" class="dashboard__enlace <?php echo enlace_actual('/registrados') ?>">
            <i class="fa-solid fa-users dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Registrados
            </span>
        </a>

        <a href="/admin/regalos" class="dashboard__enlace <?php echo enlace_actual('/regalos') ?>">
            <i class="fa-solid fa-gifts dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Regalos
            </span>
        </a>

    </nav>
</aside>