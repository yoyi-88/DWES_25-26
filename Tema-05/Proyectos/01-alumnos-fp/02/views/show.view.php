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
            <h4>Formulario mostrar artículo</h4>
            <!-- contenido principal -->

            <div class="mb-3">
                <label for="descripcion" class="form-label">ID:</label>
                <input type="number" class="form-control" id="id" name="id" value="<?= $articulo->getId() ?>" disabled>
            </div>


            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $articulo->getDescripcion() ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?= $articulo->getModelo() ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="modelo" class="form-label">Marca</label>
                <input type="text" class="form-control" id="marca" value="<?= $marcas[$articulo->getMarca()] ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="modelo" class="form-label">Categorías</label>
                <input type="text" class="form-control" id="categorias[]" value="<?= implode(", ", Class_tabla_articulos::categorias_indices_a_nombres($articulo->getCategorias())); ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="unidades" class="form-label">Unidades</label>
                <input type="number" class="form-control" id="unidades" name="unidades" value="<?= $articulo->getUnidades() ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" value="<?= $articulo->getPrecio() ?>" disabled>
            </div>

            <a href="index.php" class="btn btn-danger">volver</a>



        </main>

        <!-- pie de página -->
        <?php require_once 'views/partials/footer.partial.php'; ?>
    </div>
    <!-- javascript bootstrap5.3.8 -->
    <?php require_once 'views/layouts/javascript.php'; ?>
</body>

</html>