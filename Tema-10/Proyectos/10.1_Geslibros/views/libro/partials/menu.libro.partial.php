<nav class="navbar navbar-expand-lg bg-body-tertiary primary">
    <div class="container-fluid">
        <i class="bi bi-book"></i>
        <a class="navbar-brand" href="<?= URL ?>libro">Libros</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link 
                    <?= in_array($_SESSION['role_id'], $GLOBALS['libro']['new']) ? 'active' : 'disabled' ?>"
                        aria-current="page" href="<?= URL ?>libro/new">Nuevo</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle 
                    <?= in_array($_SESSION['role_id'], $GLOBALS['libro']['order']) ? 'active' : 'disabled' ?>"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ordenar por
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= URL ?>libro/order/1">Id</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>libro/order/2">Título</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>libro/order/3">Autor</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>libro/order/4">Editorial</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>libro/order/5">Géneros</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>libro/order/6">Stock</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>libro/order/7">Precio</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link 
                    <?= in_array($_SESSION['role_id'], $GLOBALS['libro']['export']) ? 'active' : 'disabled' ?>"
                        href="<?= URL ?>libro/export">Exportar CSV</a>
                </li>
                
                <li>
                    <a class="nav-link <?= !in_array($_SESSION['role_id'], $GLOBALS['libro']['pdf']) ? 'disabled' : 'active' ?>" href="<?= URL ?>libro/pdf" target="_blank" title="Generar informe en PDF">
                    Exportar PDF</a>
                </li>
            </ul>

            <div class="d-flex flex-wrap gap-2">
                <form class="d-flex" action="<?= URL ?>libro/import" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                    <input class="form-control me-2 form-control-sm" style="max-width: 200px;" type="file" name="archivo_csv" accept=".csv" required
                        <?= !in_array($_SESSION['role_id'], $GLOBALS['libro']['import']) ? 'disabled' : '' ?>
                        title="Seleccionar archivo CSV">

                    <button class="btn btn-outline-success btn-sm" type="submit"
                        <?= !in_array($_SESSION['role_id'], $GLOBALS['libro']['import']) ? 'disabled' : '' ?>>
                        Importar
                    </button>
                </form>

                <form class="d-flex" method="GET" action="<?= URL ?>libro/search">
                    <input class="form-control me-2 form-control-sm" type="search" placeholder="buscar..." aria-label="Search" name="term"
                        <?= !in_array($_SESSION['role_id'], $GLOBALS['libro']['search']) ? 'disabled' : '' ?>>
                    
                    <button class="btn btn-outline-secondary btn-sm" type="submit"
                        <?= !in_array($_SESSION['role_id'], $GLOBALS['libro']['search']) ? 'disabled' : '' ?>>
                        Buscar
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>