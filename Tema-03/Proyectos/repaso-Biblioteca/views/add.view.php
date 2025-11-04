<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión biblioteca</title>

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
            <i class="bi bi-emoji-heart-eyes"></i>
            <span class="fs-6">Gestión biblioteca</span>
        </header>

        <!-- contenido principal -->
        <main>
            <h1 class="mb-4">Libro específico</h1>

            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Título</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Introduzca título" ?>" required>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Autor</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" value="<?=  $libro['autor']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput3" class="form-label">Género</label>
                <input type="text" class="form-control" id="formGroupExampleInput3" value="<?=  $libro['genero']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput4" class="form-label">Copias</label>
                <input type="text" class="form-control" id="formGroupExampleInput4" value="<?=  $libro['copias']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput5" class="form-label">Publicación</label>
                <input type="text" class="form-control" id="formGroupExampleInput5" value="<?=  $libro['publicacion']; ?>" required>
            </div>


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