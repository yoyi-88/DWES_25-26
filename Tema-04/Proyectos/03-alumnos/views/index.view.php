<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title>Proyecto 4.3 - Alumnos</title>

</head>

<body>
    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php require_once 'views/partials/header.partial.php'; ?>

        <?php require_once 'views/partials/menu.partial.php' ?>

        <!-- contenido principal -->
        <main>
            <h2 class="border-bottom">Tabla alumnos</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Email</th>
                        <th scope="col">Curso</th>
                        <th scope="col">Asignaturas</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $alumno) : ?>
                        <tr>
                            <th><?= $alumno->getId(); ?></th>
                            <td><?= $alumno->getNombre(); ?></td>
                            <td><?= $alumno->getApellidos(); ?></td>
                            <td><?= $alumno->getEmail(); ?></td>
                            <td><?= $cursos[$alumno->getCurso()]; ?></td>
                            <td><?= implode(", ", Class_tabla_alumnos::asignaturas_indices_a_nombres($alumno->getAsignaturas())); ?></td>

                            <td>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <a href="edit.php?id=<?= $alumno->getId(); ?>" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="bi bi-pen"></i>
                                    </a>
                                    <a href="delete.php?id=<?= $alumno->getId(); ?>" class="btn btn-danger btn-sm" title="Eliminar"
                                        onclick="return confirm('Confirmar eliminación del artículo')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="show.php?id=<?= $alumno->getId(); ?>" class="btn btn-primary btn-sm" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                </div>

                            </td>
                        <?php endforeach; ?>
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