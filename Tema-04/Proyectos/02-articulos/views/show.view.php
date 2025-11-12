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
            <h4>Mostrar artículo</h4>
            <!-- contenido principal -->
            <form action="update.php?id=<?= $id_editar ?>" method="POST">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $articulo['descripcion']?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" value="<?= $articulo['modelo']?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Categoría</label>
                    <input type="number" class="form-control" id="categoria_id" name="categoria_id" value="<?= $articulo['categoria_id']?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="unidades" name="unidades" value="<?= $articulo['unidades']?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Precio</label>
                    <input type="float" class="form-control" id="precio" name="precio" value="<?= $articulo['precio']?>" readonly>
                </div>

                <div>
                    <a href="index.php" class="btn btn-primary">Volver</a>
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