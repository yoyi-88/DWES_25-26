<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once("template/partials/menu.partial.php") ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <!-- capa de mensajes -->
        <?php require_once("template/partials/mensaje.partial.php") ?>

        <!-- capa de errores -->
        <?php require_once("template/partials/error.partial.php") ?>

        <!-- Mostrar tabla de  alumnos -->
        <!-- contenido principal -->
        <main>
            <legend>Tabla de Alumnos</legend>
            <!-- Menú principal de gestión de alumnos de FP -->
            <?php require_once("views/alumno/partials/menu.alumno.partial.php") ?>
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
                        <?php while ($alumno = $this->alumnos->fetch()): ?>
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
                                        <a href="<?=  URL ?>alumno/delete/<?= $alumno['id'] ?>" class="btn btn-danger btn-sm" title="Eliminar"
                                            onclick="return confirm('Confimar elimación del artículo')">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                        <!-- boton editar -->
                                        <a href="<?=  URL ?>alumno/edit/<?= $alumno['id'] ?>" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <!-- boton ver -->
                                        <a href="<?=  URL ?>alumno/show/<?= $alumno['id'] ?>" class="btn btn-primary btn-sm" title="Ver">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </td>


                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">Total Alumnos: <?= $this->alumnos->rowCount() ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br><br><br>

        </main>

    </div>

    <!-- /.container -->

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>