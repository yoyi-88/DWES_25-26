<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title>Proyecto 5.1 - CRUD Gestión Alumnos PHP y MySql</title>

</head>

<body>
    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php require_once 'views/partials/header.partial.php'; ?>

        <main>
            <h4>Formulario Nuevo Alumno</h4>
            <!-- contenido principal -->
            <form action="create.php" method="POST">

                <!-- Se excluyen los campos id, población, provincia y dirección por simplificar -->

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control"  name="nombre" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="dni" class="form-label">DNI:</label>
                    <input type="text" class="form-control" name="dni" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="tel" class="form-control" name="telefono" required>
                </div>

                <div class="mb-3">
                    <label for="nacionalidad" class="form-label">Nacionalidad:</label>
                    <input type="text" class="form-control" name="nacionalidad" required>
                </div>

                <div class="mb-3">
                    <label for="fecha_nac" class="form-label">Fecha nacimiento:</label>
                    <input type="date" class="form-control" name="fecha_nac" required>
                </div>

                

                <div class="mb-3">
                    <label for="marca" class="form-label">Cursos:</label>
                    <select class="form-select" name="curso_id" required>
                        <option selected disabled>Seleccione curso</option>
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?= $curso['id'] ?>">
                                <?= $curso['curso'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                

                <div class="mb-3">
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Añadir</button>
                </div>
            </form>
            <br>
            <br>
            <br>


        </main>

        <!-- pie de página -->
        <?php require_once 'views/partials/footer.partial.php'; ?>
    </div>
    <!-- javascript bootstrap5.3.8 -->
    <?php require_once 'views/layouts/javascript.php'; ?>
</body>

</html>