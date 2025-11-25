<nav class="navbar navbar-expand-lg bg-body-tertiary primary">
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
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ordenar por
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="order.php?criterio=1">Id</a></li>
                        <li><a class="dropdown-item" href="order.php?criterio=2">Alumno</a></li>
                        <li><a class="dropdown-item" href="order.php?criterio=3">Email</a></li>
                        <li><a class="dropdown-item" href="order.php?criterio=4">Nacionalidad</a></li>
                        <li><a class="dropdown-item" href="order.php?criterio=5">Dni</a></li>
                        <li><a class="dropdown-item" href="order.php?criterio=6">Edad</a></li>
                        <li><a class="dropdown-item" href="order.php?criterio=7">Curso</a></li>
                       
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
               
            </ul>
            <form class="d-flex" role="search" method="GET" action="search.php">
                <input class="form-control me-2" type="search" placeholder="buscar..." aria-label="Search" name="prompt"/>
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>