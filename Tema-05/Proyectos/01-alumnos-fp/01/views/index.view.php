<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title>Proyecto 5.1 - CRUD Gestión Alumnos mysql</title>

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
                        <th scope="col">Alumno</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nacionalidad</th>
                        <th scope="col">DNI</th>
                        <th scope="col" class="text-end">Edad</th>
                        <th scope="col" class="text-end">Curso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- $alumnos es un objeto mysqli_result, se puede usar foreach directamente sólo cuando 
                    cada iteración devuelve un array asociativo -->
                    <?php while ($alumno = $alumnos->fetch_assoc()) : ?>
                        <tr>
                            <th><?= $alumno['id']; ?></th>
                            <td><?= $alumno['alumno']; ?></td>
                            <td><?= $alumno['email']; ?></td>    
                            <td><?= $alumno['nacionalidad']; ?></td>
                            <td><?= $alumno['dni']; ?></td>
                            <td class="text-end"><?= $alumno['edad']; ?></td>
                            <td><?= $alumno['curso']; ?></td>
                            <td>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <a href="edit.php?id=<?= $alumno['id']; ?>" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="bi bi-pen"></i>
                                    </a>
                                    <a href="delete.php?id=<?= $alumno['id']; ?>" class="btn btn-danger btn-sm" title="Eliminar"
                                        onclick="return confirm('Confirmar eliminación del artículo')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="show.php?id=<?= $alumno['id']; ?>" class="btn btn-primary btn-sm" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                </div>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">Total alumnos: <?=  $alumnos->num_rows ?></td>
                    </tr>
                </tfoot>
            </table>


        </main>

        <!-- pie de página -->
        <?php require_once 'views/partials/footer.partial.php'; ?>
    </div>
    <!-- javascript bootstrap5.3.8 -->
    <?php require_once 'views/layouts/javascript.php'; ?>
</body>

</html>