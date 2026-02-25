<!-- menú principal Artículos -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= URL ?>alumno">Alumnos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link 
                    <?= in_array($_SESSION['role_id'], $GLOBALS['alumno']['new'])? 'active':'disabled' ?>" 
                    aria-current="page" href="<?= URL ?>alumno/new">Nuevo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link 
                    <?= in_array($_SESSION['role_id'], $GLOBALS['alumno']['export'])? 'active':'disabled' ?>" 
                    href="<?= URL ?>alumno/export/csv" title="Exportar CSV">Exportar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link 
                    <?= in_array($_SESSION['role_id'], $GLOBALS['alumno']['import'])? 'active':'disabled' ?>" 
                    href="<?= URL ?>alumno/import/csv" title="Importar CSV">Importar</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle
                    <?= in_array($_SESSION['role_id'], $GLOBALS['alumno']['order'])? 'active':'disabled' ?>" 
                    href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/order/1">Id</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/order/2">Alumno</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/order/3">Email</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/order/4">Teléfono</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/order/5">Nacionalidad</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/order/6">DNI</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/order/7">Curso</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/order/8">Edad</a></li>   
                    </ul>
                </li>

            </ul>
            <form class="d-flex" role="search" action="<?= URL ?>alumno/search" method="GET">
                
            <!-- protección CSRF -->
                
                <!-- expresión    -->
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="expresion" required>
                
                <!-- botones de accion -->
                <button class="btn btn-outline-primary 
                <?= in_array($_SESSION['role_id'], $GLOBALS['alumno']['search'])? null:'disabled' ?>" 
                type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>