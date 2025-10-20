<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>entrenamiento calculadora</title>

    <!-- css bootstrap5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Bootstrap icons 1.13.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-emoji-heart-eyes"></i>
            <b><span class="fs-6">Entrenamiento Calculadora</span></b>

        </header>

        <!-- contenido principal -->
        <main>
            <form method="post">
                <h1>Calculadora básica</h1>
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Valor 1:</label>
                    <input type="text" class="form-control" id="formGroupExampleInput"  step="0.01" placeholder="0" name="Valor1" required>
                    <small id="helpId" class="text-muted">loqsea</small>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Valor 2:</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" step="0.01"placeholder="0" name="Valor2" required>
                    <small id="helpId" class="text-muted">loqsea</small>
                </div>

                <div class="btn-group" role="group">
                    <button type="reset" class="btn btn-secondary">borrar</button>
                    <button type="submit" class="btn btn-primary" formaction="sumar.php">suma</button>
                    <button type="button" class="btn btn-danger">resta</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>