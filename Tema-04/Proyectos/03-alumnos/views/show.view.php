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
            <h4>Formulario mostrar alumno</h4>
            <div class="mb-3">
                <label for="id" class="form-label">ID:</label>
                <input type="number" class="form-control" id="id" name="id" value="<?= $alumno->getId() ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $alumno->getNombre() ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= $alumno->getApellidos() ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $alumno->getEmail() ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="f_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="text" class="form-control" id="f_nacimiento" name="f_nacimiento" value="<?= $alumno->getF_nacimiento() ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="curso" class="form-label">Curso</label>
                <input type="text" class="form-control" id="curso" value="<?= $cursos[$alumno->getCurso()] ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="asignaturas" class="form-label">Asignaturas</label>
                <input type="text" class="form-control" id="asignaturas" value="<?= implode(", ", Class_tabla_alumnos::asignaturas_indices_a_nombres($alumno->getAsignaturas())); ?>" disabled>
            </div>

            <a href="index.php" class="btn btn-danger">volver</a>

            

        </main>

        <!-- pie de página -->
        <?php require_once 'views/partials/footer.partial.php'; ?>
    </div>
    <!-- javascript bootstrap5.3.8 -->
    <?php require_once 'views/layouts/javascript.php'; ?>
</body>

</html>