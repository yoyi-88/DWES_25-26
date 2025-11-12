<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title>Proyecto 3.2</title>

</head>

<body>
    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php require_once 'views/partials/header.partial.php'; ?>

        <main>
            <h4>Formulario añadir artículo</h4>
            <!-- contenido principal -->
            <form action="create.php" method="POST">

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                </div>

                <div class="mb-3">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                </div>

                <div class="mb-3">
                    <label for="marca" class="form-label">Marca</label>
                    <select class="form-select" id="marca" name="marca" required>
                        <option selected disabled>Seleccione una marca</option>
                        <?php foreach ($marcas as $indice => $nombre_marca): ?>
                            <option value="<?= $indice ?>">
                                <?= $nombre_marca ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Categorías</label>
                    <div>
                        <?php foreach ($categorias as $indice => $nombre_categoria): ?>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                    type="checkbox"
                                    name="categorias[]"
                                    value="<?= $indice ?>"
                                    id="categoria_<?= $indice ?>">

                                <label class="form-check-label" for="categoria_<?= $indice ?>">
                                    <?= $nombre_categoria ?>
                                </label>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="unidades" class="form-label">Unidades</label>
                    <input type="number" class="form-control" id="unidades" name="unidades" required>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" required>
                </div>

                <div class="mb-3">
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Añadir</button>
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