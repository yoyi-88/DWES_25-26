<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.auth.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <!-- capa de mensajes -->
        <?php require_once 'template/partials/mensaje.partial.php' ?>

        <!-- capa errores -->
        <?php require_once 'template/partials/error.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                <!-- Protección ataques XSS -->
                <h5 class="card-title"><?= htmlspecialchars($this->title) ?></h5>
            </div>
            <div class="card-body">
                <!-- Formulario de alumnos  -->
                <form action="<?= URL ?>alumno/validar/csv" method="POST" enctype="multipart/form-data">

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- Fichero csv -->
                    <div class="mb-3">

                        <label for="formFile" class="form-label">
                            <legend>Formato CSV:</legend>
                            <ul>
                                <li>Columna 1: nombre</li>
                                <li>Columna 2: apellidos</li>
                                <li>Columna 3: email</li>
                                <li>Columna 4: telefono</li>
                                <li>Columna 5: nacionalidad</li>
                                <li>Columna 6: dni</li>
                                <li>Columna 7: fecha_nacimiento</li>
                                <li>Columna 8: id curso</li>
                            </ul>
                        </label>
                        <input type="file" class="form-control" name="filecsv" id="formFile" accept=".csv">
                    </div>
            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>alumno" role="button"
                    onclick="return confirm('¿Estás seguro de que deseas cancelar? Se perderán los datos ingresados.')">Cancelar</a>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            </form>
            <!-- Fin formulario -->
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->
    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>