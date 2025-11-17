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

        <main>
            <h4>Formulario editar artículo</h4>
            <!-- contenido principal -->
            <form action="update.php?id=<?= $id ?>" method="POST">

                <div class="mb-3">
                    <label for="id" class="form-label">ID:</label>
                    <input type="number" class="form-control" id="id" name="id" value="<?= $alumno->getId() ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $alumno->getNombre() ?>" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= $alumno->getApellidos() ?>" required>
                </div>

                <div class="mb-3">
                    <label for="curso" class="form-label">Curso</label>
                    <select class="form-select" id="curso" name="curso" required>
                        <option selected disabled>Seleccione un curso</option>
                        <?php foreach ($cursos as $indice => $nombre_curso): ?>
                            <option value="<?= $indice ?>"
                                <?= ($alumno->getCurso() == $indice) ? 'selected' : null ?>>
                                <?= $nombre_curso ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Asignaturas</label>
                    <div>
                        <?php foreach ($asignaturas as $indice => $nombre_asignatura): ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="asignaturas[]"
                                    value="<?= $indice ?>"
                                    <?= in_array($indice, $alumno->getAsignaturas()) ? 'checked' : null ?>>

                                <label class="form-check-label">
                                    <?= $nombre_asignatura ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $alumno->getEmail() ?>" required>
                </div>

                <div class="mb-3">
                    <label for="f_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="f_nacimiento" name="f_nacimiento" value="<?= $alumno->getF_nacimiento() ?>" required>
                </div>

                <div class="mb-3">
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Actualizar alumno</button>
                </div>
            </form>


        </main>

        <!-- pie de página -->
        <?php require_once 'views/partials/footer.partial.php'; ?>
    </div>
    <!-- javascript bootstrap5.3.8 -->
    <?php require_once 'views/layouts/javascript.php'; ?>
</body>

</html>