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

        <!-- Mostrar tabla de  libros -->
        <!-- contenido principal -->
        <main>
            <legend>Formulario Nuevo Libro</legend>
            <!-- Formulario para crear un nuevo libro -->
            <form action="<?= URL ?>libro/create" method="POST">

                <!-- Se exculyen los campos id, poblacion, provincia y dirección por simplicidad -->

                <!-- campo titulo -->
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" name="titulo" required>
                </div>

                <!-- campo autor -->
                <div class="mb-3">
                    <label for="autor" class="form-label">Autor:</label>
                    <input type="text" class="form-control" name="autor" required>
                </div>

                <!-- campo editorial -->
                <div class="mb-3">
                    <label for="editorial" class="form-label">Editorial:</label>
                    <input type="text" class="form-control" name="editorial" required>
                </div>

                <!-- campo generos -->
                <div class="mb-3">
                    <label for="generos" class="form-label">Generos:</label>
                    <input type="text" class="form-control" name="generos" required>
                </div>

                <!-- campo Stock -->
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock:</label>
                    <input type="number" class="form-control" name="stock" required>
                </div>

                <!-- campo precio -->
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio:</label>
                    <input type="number" class="form-control" name="precio" required>
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
                <a class="btn btn-secondary" href="<?=  URL ?>libro" role="button"
                    onclick="return confirm('Confimar cancelación artículo')">Cancelar</a>
                <button type="reset" class="btn btn-secondary" onclick="return confirm('Confimar reseteo artículo')">Limpiar</button>
                <button type="submit" class="btn btn-primary">Guardar libro</button>
            </form>

            <br><br><br>
        </main>

    </div>

    <!-- /.container -->

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>