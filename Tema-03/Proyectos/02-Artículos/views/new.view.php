<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto 3.2</title>

    <!-- css bootstrap5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Bootstrap icons 1.13.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <header class="pb-3 mb-4 border-bottom">
            <span class="fs-1">Proyecto 3.2 Tema 3 PHP</span>
            <h4>Gestión tabla artículos</h4>
        </header>

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
                    <input type="number" class="form-control" id="categoria_id" name="categoria_id" placeholder="Especificar id de la categoría" required>
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
        <footer class="footer mt-auto py-3 fixed-bottom bg-light">
            <div class="container">
                <span class="text-muted">&copy; 2025
                    Yoël Gómez Benítez - DWES - 2º DAW - Curso 25/26</span>
            </div>
        </footer>
    </div>
    <!-- javascript bootstrap5.3.8 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>