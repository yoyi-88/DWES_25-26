<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto 3.2</title>

    <!-- css bootstrap5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Bootstrap icons 1.13.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <header class="pb-3 mb-4 border-bottom">
            <span class="fs-1">Proyecto 3.2 Tema 3 PHP</span>
            <h4>Gestión tabla artículos</h4>
        </header>

        <?php require_once 'views/partials/nav.partial.php' ?>

        <!-- contenido principal -->
        <main>
            <h2 class="border-bottom">Tabla artículos</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Categoria_id</th>
                        <th scope="col" class="text-end">Unidades</th>
                        <th scope="col" class="text-end">Precio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($articulos); $i ++): ?>
                    <tr>
                        <th scope="row"><?= $articulos[$i]['id'] ?></th>
                        <td><?= $articulos[$i]['descripcion'] ?></td>
                        <td><?= $articulos[$i]['modelo'] ?></td>
                        <td><?= $categorias['nombre'][$articulos][$i]['categoria_id'] ?></td>
                        <td class="text-end"><?= $articulos[$i]['unidades'] ?></td>
                        <td class="text-end"><?= $articulos[$i]['precio'] ?></td>
                        <td>
                            <a href=""></a>
                            <a href=""></a>
                            <a href=""></a>
                        </td>

                    </tr>

                    <?php endfor; ?>
                </tbody>
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