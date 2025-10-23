<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 3.2 - Tabla de Libros</title>

    <!-- css bootstrap5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Bootstrap icons 1.13.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <header class="pb-1 mb-4 border-bottom">
            <span class="fs-1">Actividad 3.2 - Tabla de Libros</span>
            <p>Gestión tabla libros</p>
        </header>

        <!-- Navegador o menu libros -->
        <nav class="navbar navbar-expand-lg bg-body-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Libros</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="new.php">Añadir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- contenido principal -->
        <main>
            <h4 class="border-bottom">Tabla Libros</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Editorial</th>
                        <th scope="col">Género</th>
                        <th scope="col" class="text-end">Precio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($libros); $i++): ?>
                        <tr>
                            <th scope="row"><?= $libros[$i]['id'] ?></th>
                            <td><?= $libros[$i]['titulo'] ?></td>
                            <td><?= $libros[$i]['autor'] ?></td>
                            <td><?= $libros[$i]['editorial'] ?></td>
                            <td><?= $libros[$i]['genero'] ?></td>
                            <td class="text-end"><?= number_format($libros[$i]['precio'], 2, ',', '.') ?></td>

                            <!-- Botones de acción -->
                            <td>
                                <a href="delete.php?id=<?= $libros[$i]['id'] ?>" class="btn btn-danger btn-sm" title="Eliminar">
                                    <i class="bi bi-trash3"></i>
                                </a>

                                
                            </td>

                        </tr>


                    <?php endfor; ?>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">Total libros: <?= count($libros) ?></td>
                    </tr>
                </tfoot>

            </table>


        </main>

        <!-- pie de página -->
        <footer class="footer mt-auto py-3 fixed-bottom bg-light">
            <div class="container">
                <span class="text-muted">&copy; 2025
                    Yoël Gómez Benítez - DWES - 2º DAW - Curso 25/26</span>
            </div>
        </footer>
    </div>
    <!-- javascript bootstrap5.3.8 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>