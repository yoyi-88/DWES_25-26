<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Framework bootstrap -->
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title>Editar Libro - Geslibros</title>
</head>

<body>

    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php require_once 'views/partials/header.partial.php'; ?>


        <!-- contenido principal -->
        <main>
            <!-- Formulario añadir nuevo libro -->
            <legend>Formulario Edición Libro</legend>
            <form action="update.php?id=<?= $id?>" method="POST">

                <!-- campo id -->
                <div class="mb-3">
                    <label for="id" class="form-label">ID:</label>
                    <input type="number" class="form-control" id="id" name="id" value="<?= $libro['id']; ?>" readonly>
                </div>

                <!-- campo titulo -->
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $libro['titulo']; ?>">
                </div>

                <!-- campo autor -->
                <div class="mb-3">
                    <label for="autor" class="form-label">Autor:</label>
                    <input type="text" class="form-control" id="autor" name="autor" value="<?= $libro['autor']; ?>">
                </div>

                <!-- campo genero -->
                <div class="mb-3">
                    <label for="genero" class="form-label">Género:</label>
                    <input type="text" class="form-control" id="genero" name="genero" value="<?= $libro['genero']; ?>">
                </div>

                <!-- campo editorial -->
                <div class="mb-3">
                    <label for="editorial" class="form-label">Editorial:</label>
                    <input type="text" class="form-control" id="editorial" name="editorial" value="<?= $libro['editorial']; ?>">
                </div>

                <!-- campo precio -->
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio:</label>
                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?= $libro['precio']; ?>">
                </div>

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Actualizar Libro</button>
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