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

        <!-- contenido principal -->
        <main>
            <h4 class="border-bottom">Tabla Libros</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-end">id</th>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Género</th>
                        <th scope="col" class="text-end">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($libros); $i++): ?>
                        <tr>
                            <th scope="row" class="text-end"><?= $i ?></th>
                            <td><?= htmlspecialchars($libros[$i]['titulo']) ?></td>
                            <td><?= htmlspecialchars($libros[$i]['autor']) ?></td>
                            <td><?= htmlspecialchars($libros[$i]['genero']) ?></td>
                            <td class="text-end"><?= htmlspecialchars(number_format($libros[$i]['precio'], 2, ',', '.')) ?></td>
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