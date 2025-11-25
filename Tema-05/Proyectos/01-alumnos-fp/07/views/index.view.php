<!DOCTYPE html>
<html lang="es">

<head>

    <!-- Cargar bootstrap -->
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title> Proyecto 5.1 - CRUD Gestión Alumnos PHP y MySQL</title>

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
                    <!-- cabecera tabla alumnos -->
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Alumno</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nacionalidad</th>
                            <th scope="col">DNI</th>
                            <th scope="col" class="text-end">Edad</th>
                            <th>Curso</th>
                            <th scope="col">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- $alumnos es un objeto mysqli_result, se puede usar foreach directamente  -->
                        <!-- solo cuando cada iteración devuelve un array asociativo -->
                        <?php  while ($alumno = $alumnos->fetch_assoc()): ?>
                            <tr class="">
                                <td><?= $alumno['id'] ?></td>
                                <td><?= $alumno['alumno'] ?></td>
                                <td><?= $alumno['email'] ?></td>
                                <td><?= $alumno['nacionalidad'] ?></td>
                                <td><?= $alumno['dni'] ?></td>
                                <td class="text-end"><?= $alumno['edad'] ?></td>
                                <td><?= $alumno['curso']  ?></td>

                                <!-- botones de acción -->
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <!-- boton eliminar -->
                                        <a href="delete.php?id=<?= $alumno['id'] ?>" class="btn btn-danger btn-sm" title="Eliminar"
                                            onclick="return confirm('Confimar elimación del artículo')">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                        <!-- boton editar -->
                                        <a href="edit.php?id=<?= $alumno['id'] ?>" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <!-- boton ver -->
                                        <a href="show.php?id=<?= $alumno['id'] ?>" class="btn btn-primary btn-sm" title="Ver">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </td>


                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">Total Artículos: <?= $alumnos->num_rows ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </main>

        <!-- pie de página -->
        <?php require_once 'views/partials/footer.partial.php'; ?>
    </div>

    <!-- javaScript bootstrap 5.3.8 -->
    <?php require_once 'views/layouts/js_bootstrap.layout.php'; ?>
</body>

</html>