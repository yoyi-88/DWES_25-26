<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Cargar bootstrap -->
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title> Proyecto 4.2 - CRUD Gestión Artículos POO</title>
</head>

<body>

    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php require_once 'views/partials/header.partial.php'; ?>

        <!-- contenido principal -->
        <main>
            <!-- Formulario añadir nuevo libro -->
            <legend>Formulario Mostrar Artículo</legend>
            <form>

                <!-- campo id -->
                <div class="mb-3">
                    <label for="id" class="form-label">ID:</label>
                    <input type="number" class="form-control" id="id" name="id" value="<?=  $articulo->getId() ?>" disabled>
                </div>

                <!-- campo descripción -->
                <div class="mb-3">
                    <label for="titulo" class="form-label">Descripción:</label>
                    <input type="text" class="form-control" id="titulo" name="descripcion" value="<?=  $articulo->getDescripcion() ?>" disabled>
                </div>

                <!-- campo modelo -->
                <div class="mb-3">
                    <label for="autor" class="form-label">Modelo:</label>
                    <input type="text" class="form-control" id="autor" name="modelo" value="<?=  $articulo->getModelo() ?>" disabled>
                </div>

                <!-- campo marca -->
                <div class="mb-3">
                    <label for="autor" class="form-label">Marca:</label>
                    <input type="text" class="form-control" id="autor" name="modelo" value="<?=  $marcas[$articulo->getMarca()] ?>" disabled>
                </div>

                <!-- campo unidades -->
                <div class="mb-3">
                    <label for="precio" class="form-label">Unidades:</label>
                    <input type="number" step="0.01" class="form-control" id="precio" name="unidades" value="<?=  $articulo->getUnidades() ?>" disabled>
                </div>

                <!-- campo precio -->
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio:</label>
                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?=  $articulo->getPrecio() ?>" disabled>
                </div>

                 <!-- campo categorias -->
                <div class="mb-3">
                    <label for="autor" class="form-label">Categorias:</label>
                    <input type="text" class="form-control" value="<?=  implode(', ', Class_tabla_articulos::categorias_indices_a_nombres($articulo->getCategorias())) ?>" disabled>
                </div>

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="index.php" role="button">Volver</a>
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