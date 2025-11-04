<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Cargar bootstrap -->
    <?php include 'views/layouts/head.layout.php'; ?>
    <title> Proyecto - CRUD Gestión Películas</title>
</head>

<body>

    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php include 'views/partials/header.partial.php'; ?>

        <!-- contenido principal -->
        <main>
            <!-- Formulario añadir nueva película -->
            <legend>Formulario Editar Película</legend>
            <form action="update.php" method="POST">

                <!-- campo id -->
                <div class="mb-3">
                    <label for="id" class="form-label">ID:</label>
                    <input type="number" class="form-control" id="id" name="id" value="<?= $pelicula['id'] ?>" readonly>
                </div>

                <!-- campo titulo -->
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $pelicula['titulo'] ?>" required>
                </div>

                <!-- campo idioma -->
                <div class="mb-3">
                    <label for="idioma" class="form-label">Idioma:</label>
                    <input type="text" class="form-control" id="idioma" name="idioma" value="<?= $pelicula['idioma'] ?>" required>
                </div>

                <!-- campo director -->
                <div class="mb-3">
                    <label for="director" class="form-label">Director:</label>
                    <input type="text" class="form-control" id="director" name="director" value="<?= $pelicula['director'] ?>" required>


                <!-- campo genero -->
                <div class="mb-3">
                    <label for="generos" class="form-label">Géneros:</label>
                    <input type="text" class="form-control" id="generos" name="generos" value="<?= implode(', ', $pelicula['generos']) ?>" placeholder="Ejemplo: ficción, romántica, drama" required>
                </div>

                <!-- campo año -->
                <div class="mb-3">
                    <label for="anio" class="form-label">Año:</label>
                    <input type="number" class="form-control" id="anio" name="anio" value="<?= $pelicula['anio'] ?>" required>

                </div>

                <!-- campo recaudacion -->
                <div class="mb-3">
                    <label for="recaudado" class="form-label">Recaudado (en millones):</label>
                    <input type="number" class="form-control" id="recaudado" name="recaudado" value="<?= $pelicula['recaudado'] ?>" step="0.01" required>
                </div>

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
                <button type="reset" class="btn btn-secondary">Limpiar</button>
                <button type="submit" class="btn btn-primary">Guardar Película</button>
            </form>

            <br>
            <br>
            <br>
        </main>
        <!-- pie de página -->
        <?php include 'views/partials/footer.partial.php'; ?>
    </div>

    <!-- javaScript bootstrap 5.3.8 -->
    <?php include 'views/layouts/js_bootstrap.layout.php'; ?>

</body>

</html>