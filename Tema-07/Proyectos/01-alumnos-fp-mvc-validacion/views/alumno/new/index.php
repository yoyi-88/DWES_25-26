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
            <legend>Formulario Nuevo Alumno</legend>
            <!-- Formulario para crear un nuevo alumno -->
            <form action="<?=  URL ?>alumno/create" method="POST">

                <!-- Se exculyen los campos id, poblacion, provincia y dirección por simplicidad -->

                <!-- campo nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>

                <!-- campo apellidos -->
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" required>
                </div>

                <!-- campo email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <!-- campo dni -->
                <div class="mb-3">
                    <label for="email" class="form-label">DNI:</label>
                    <input type="text" class="form-control" name="dni" required>
                </div>

                <!-- campo teléfono -->
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="tel" class="form-control" name="telefono" required>
                </div>

                <!-- campo nacionalidad -->
                <div class="mb-3">
                    <label for="email" class="form-label">Nacionalidad:</label>
                    <input type="text" class="form-control" name="nacionalidad" required>
                </div>

                <!-- campo fecha nacimiento -->
                <div class="mb-3">
                    <label for="fecha_nac" class="form-label">Fecha Nacimiento:</label>
                    <input type="date" class="form-control" name="fecha_nac" required>
                </div>

                <!-- Select Dinámico Cursos -->
                <div class="mb-3">
                    <label for="curso" class="form-label">Cursos:</label>
                    <select class="form-select" name="curso_id" required>
                        <option selected disabled>Seleccione Curso</option>
                        <!-- mostrar lista marcas -->
                        <?php foreach ($this->cursos as $indice => $curso): ?>
                            <option value="<?= $indice ?>">
                                <?= $curso ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?=  URL ?>alumno" role="button"
                    onclick="return confirm('Confimar cancelación artículo')">Cancelar</a>
                <button type="reset" class="btn btn-secondary" onclick="return confirm('Confimar reseteo artículo')">Limpiar</button>
                <button type="submit" class="btn btn-primary">Guardar Alumno</button>
            </form>

            <br><br><br>
        </main>

    </div>

    <!-- /.container -->

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>