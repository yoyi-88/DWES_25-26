<!DOCTYPE html>
<html lang="es">

<head>

    <!-- Cargar bootstrap -->
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title> Proyecto 5.2 - Panel Control de Clientes - GESBANK</title>

</head>

<body>

    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php require_once 'views/partials/header.partial.php'; ?>

        <!-- mensajes de error -->
        <?php require_once 'views/partials/error.partial.php'; ?>

        <!-- mensajes de notificación -->
        <?php require_once 'views/partials/notify.partial.php'; ?>

        <!-- Navegador o menu libros -->
        <?php require_once 'views/partials/menu.partial.php'; ?>

        <!-- contenido principal -->
        <main>

            <div class="table-responsive">
                <table class="table table-hover">
                    <!-- cabecera tabla libros -->
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Ciudad</th>
                            <th scope="col">DNI</th>
                            <th scope="col">Email</th>
                            <th scope="col">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- $libros es un objeto mysqli_result, se puede usar foreach directamente  -->
                        <!-- solo cuando cada iteración devuelve un array asociativo -->
                        <?php  while ($cliente = $clientes->fetch()): ?>
                            <tr class="">
                                <td><?= $cliente->id ?></td>
                                <td><?= $cliente->apellidos ?></td>
                                <td><?= $cliente->nombre ?></td>
                                <td><?= $cliente->telefono ?></td>
                                <td><?= $cliente->ciudad ?></td>
                                <td><?= $cliente->dni ?></td>
                                <td><?= $cliente->email ?></td>

                                <!-- botones de acción -->
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <!-- boton eliminar -->
                                        <a href="delete.php?id=<?= $cliente->id ?>" class="btn btn-danger btn-sm" title="Eliminar"
                                            onclick="return confirm('Confimar elimación del artículo')">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                        <!-- boton editar -->
                                        <a href="edit.php?id=<?= $cliente->id ?>" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <!-- boton ver -->
                                        <a href="view.php?id=<?= $cliente->id ?>" class="btn btn-primary btn-sm" title="Ver">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </td>


                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">Total Clientes: <?= $clientes->rowCount() ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </main>

       
    </div>
    <br><br><br>
    <!-- pie de página -->
    <?php require_once 'views/partials/footer.partial.php'; ?>
    <!-- javaScript bootstrap 5.3.8 -->
    <?php require_once 'views/layouts/js_bootstrap.layout.php'; ?>
</body>

</html>