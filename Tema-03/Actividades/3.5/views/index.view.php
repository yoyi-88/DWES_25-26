<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title>Actividad 3.2 - Tabla de Libros</title>
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
        <?php require_once 'views/partials/menu.partial.php'; ?>


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
                                <a href="edit.php?id=<?= $libros[$i]['id'] ?>" class="btn btn-primary btn-sm" title="Editar">
                                    <i class="bi bi-pen"></i>
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
        <?php require_once  'views/partials/footer.partial.php'; ?>
    </div>
    <!-- javascript bootstrap5.3.8 -->
    <?php require_once 'views/layouts/js.bootstrap.layout.php'; ?>
</body>

</html>