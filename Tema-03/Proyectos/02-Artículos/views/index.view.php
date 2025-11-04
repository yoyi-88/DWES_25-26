<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title>Proyecto 3.2</title>

</head>

<body>
    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php require_once 'views/partials/header.partial.php'; ?>

        <?php require_once 'views/partials/menu.partial.php' ?>

        <!-- contenido principal -->
        <main>
            <h2 class="border-bottom">Tabla artículos</h2>
            <table class="table table-striped table-hover">
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
                    <?php for ($i = 0; $i < count($articulos); $i++): ?>
                        <tr>
                            <th scope="row"><?= $articulos[$i]['id'] ?></th>
                            <td><?= $articulos[$i]['descripcion'] ?></td>
                            <td><?= $articulos[$i]['modelo'] ?></td>

                            <td><?= get_nombre_categoria($articulos[$i]['categoria_id']) ?></td>
                            <td class="text-end"><?= $articulos[$i]['unidades'] ?></td>
                            <td class="text-end"><?= number_format($articulos[$i]['precio'], 2, ',', '.') ?></td>
                            <td>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <a href="edit.php?id=<?= $articulos[$i]['id'] ?>" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="bi bi-pen"></i>
                                    </a>
                                    <a href="delete.php?id=<?= $articulos[$i]['id'] ?>" class="btn btn-danger btn-sm" title="Eliminar"
                                        onclick="return confirm('Confirmar eliminación del artículo')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="show.php?id=<?= $articulos[$i]['id'] ?>" class="btn btn-primary btn-sm" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endfor; ?>
                </tbody>
            </table>


        </main>

        <!-- pie de página -->
        <?php require_once 'views/partials/footer.partial.php'; ?>
    </div>
    <!-- javascript bootstrap5.3.8 -->
    <?php require_once 'views/layouts/javascript.php'; ?>
</body>

</html>