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
                    <label for="formGroupExampleInput" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Añadir Descripcion" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Concretar modelo" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Categoría</label>
                    <select class="form-select" id="categoria_id" name="categoria_id" required>
                        <option selected disabled>Seleccione una categoría</option>
                        <!-- mostrar lista de categorias -->
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id'] ?>">
                                <?= $categoria['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="unidades" name="unidades" placeholder="Definir stock" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Precio</label>
                    <input type="float" class="form-control" id="precio" name="precio" placeholder="Detallar precio" required>
                </div>

                <div>
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