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
            <h4>Formulario editar artículo</h4>
            <!-- contenido principal -->
            <form action="update.php?id=<?= $id_editar ?>" method="POST">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $articulo['descripcion']?>" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" value="<?= $articulo['modelo']?>" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Marcas</label>
                    <select class="form-control" id="categorias" name="categorias" value="<?= $articulo['categoria_id']?>" required>
                        <option selected disabled>-- Seleccione una marca --</option>
                        <!-- mostrar lista Marcas -->
                        <?php foreach ($marcas as $indice=>$marca) : ?>
                            <option value="<?= $marca['id'] ?>" 
                                <?= $articulo['marca_id'] == $marca['id'] ? 'selected' : '' ?>>
                                <?= $marca['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="unidades" name="unidades" value="<?= $articulo['unidades']?>" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Precio</label>
                    <input type="float" class="form-control" id="precio" name="precio" value="<?= $articulo['precio']?>" required>
                </div>

                <!-- lista checkbox dinamica de categorias -->
                <div class="mb-3">
                    <label class="form-label">Categorías</label>
                    <div class="form-control">
                        <?php foreach ($categorias as $indice=>$categoria) : ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="categorias[]"
                                value="<?= $indice ?>">
                                <label class="form-check-label">
                                    <?= $categoria ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>

                <div>
                    <a href="index.php" class="btn btn-danger" 
                    onclick="return confirm('Confirmar cancelación de la edición')">Cancelar</a>

                    <button type="reset" class="btn btn-secondary"
                    onclick="return confirm('Confirmar reseteo de la información artículo')">Reset</button>

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