<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Alumnos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="new.php">Nuevo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="order.php?campo=id">Por ID</a></li>
                        <li><a class="dropdown-item" href="order.php?campo=descripcion">Por Descripción</a></li>
                        <li><a class="dropdown-item" href="order.php?campo=modelo">Por Modelo</a></li>
                        <li><a class="dropdown-item" href="order.php?campo=categoria">Por Categoría</a></li>
                        <li><a class="dropdown-item" href="order.php?campo=unidades">Por Unidades</a></li>
                        <li><a class="dropdown-item" href="order.php?campo=precio">Por Precio</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search" method="GET" action="search.php">
                <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search" name="busqueda"/>
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>