<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title>Actividad 3.2 - Editar libro geslibros</title>


</head>

<body>
    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <header class="pb-1 mb-4 border-bottom">
            <span class="fs-1">Actividad 3.3 - Añadir libros</span>
            <p>Gestión tabla libros</p>
        </header>

        <!-- contenido principal -->
        <main>
            



            <!-- Formulario editar libro -->
            <form action="create.php" method="POST">
                <div class="mb-3">
                    <label for="id" class="form-label">ID:</label>
                    <input type="number" class="form-control" id="id" name="id" value="<?= $libro['id'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $libro['titulo'] ?>" >
                </div>
                <div class="mb-3">
                    <label for="autor" class="form-label">Autor:</label>
                    <input type="text" class="form-control" id="autor" name="autor" value="<?= $libro['autor'] ?>" >
                </div>
                <div class="mb-3">
                    <label for="editorial" class="form-label">Editorial:</label>
                    <input type="text" class="form-control" id="editorial" name="editorial" value="<?= $libro['editorial'] ?>" >
                </div>
                <div class="mb-3">
                    <label for="genero" class="form-label">Género:</label>
                    <input type="text" class="form-control" id="genero" name="genero" value="<?= $libro['genero'] ?>" >
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio:</label>
                    <input type="float" class="form-control" id="precio" name="precio" value="<?= $libro['precio'] ?>" >
                </div>

                <!-- Botones de acción -->
                 
                <div>
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                    <button type="reset" class="btn btn-secondary">Limpiar</button>
                    <button type="submit" class="btn btn-primary" formaction="edit.php">Guardar</button>
                </div>
                

            </form>


        </main>

        <!-- pie de página -->
        <?php require_once 'views/partials/footer.partial.php'; ?>
    </div>
    <!-- javascript bootstrap5.3.8 -->
    <?php require_once 'views/layouts/js.bootstrap.layout.php'; ?>
</body>

</html>