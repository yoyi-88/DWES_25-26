<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Cargar bootstrap -->
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title> Proyecto 5.1 - CRUD Gestión Corredores PHP y MySQL</title>
</head>

<body>

    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php require_once 'views/partials/header.partial.php'; ?>

        <!-- contenido principal -->
        <main>
            <!-- Formulario añadir nuevo libro -->
            <legend>Formulario Nuevo Corredor</legend>
            <form action="create.php" method="POST">

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
                    <label for="ciudad" class="form-label">Ciudad:</label>
                    <input type="text" class="form-control" name="ciudad" required>
                </div>

                <!-- campo dni -->
                <div class="mb-3">
                    <label class="form-label d-block">Sexo:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" id="sexoHombre" value="Hombre">
                        <label class="form-check-label" for="sexoHombre">Hombre</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" id="sexoMujer" value="Mujer">
                        <label class="form-check-label" for="sexoMujer">Mujer</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" id="sexoOtro" value="Sin Especificar">
                        <label class="form-check-label" for="sexoOtro">Sin Especificar</label>
                    </div>
                </div>

                <!-- campo teléfono -->
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                    <input type="date" class="form-control" name="fecha_nacimiento" required>
                </div>

                <!-- campo nacionalidad -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <!-- campo fecha nacimiento -->
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI:</label>
                    <input type="text" class="form-control" name="dni" required>
                </div>


                <!-- Select Dinámico Cursos -->
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categorias:</label>
                    <select class="form-select" name="categoria_id" required>
                        <option selected disabled>Seleccione Categoría</option>
                        <!-- mostrar lista marcas -->
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id'] ?>">
                                <?= $categoria['categoria'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="club" class="form-label">Clubs:</label>
                    <select class="form-select" name="club_id" required>
                        <option selected disabled>Seleccione Club</option>
                        <!-- mostrar lista marcas -->
                        <?php foreach ($clubs as $club): ?>
                            <option value="<?= $club['id'] ?>">
                                <?= $club['club'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>




                <!-- botones de acción -->
                <a class="btn btn-secondary" href="index.php" role="button"
                    onclick="return confirm('Confimar cancelación artículo')">Cancelar</a>
                <button type="reset" class="btn btn-secondary" onclick="return confirm('Confimar reseteo artículo')">Limpiar</button>
                <button type="submit" class="btn btn-primary">Guardar Alumno</button>
            </form>

            <br>
            <br>
            <br>
        </main>
        <!-- pie de página -->
        <?php require_once 'views/partials/footer.partial.php'; ?>

        <!-- javaScript bootstrap 5.3.8 -->
        <?php require_once 'views/layouts/js_bootstrap.layout.php'; ?>
</body>

</html>