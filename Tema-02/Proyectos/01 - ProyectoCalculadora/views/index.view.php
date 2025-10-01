<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto 2.1 - Calculadora Básica con PHP</title>

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
        
            <i class="bi bi-calculator"></i>
            <span class="fs-6">Proyecto 2.1 - Tema 2 DWES 25/26</span>
        </header>

        <!-- contenido principal -->
        <main>
            <!-- Formulario de la calculadora básica -->
            <form method="post">
                <!-- Valor 1: -->
                <div class="input-group mb-3">
                    <span class="input-group-text">Valor 1:</span>
                    <input type="number" class="form-control" step="0.01" placeholder="0.00" name="valor1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Valor 2:</span>
                    <input type="number" class="form-control" step="0.01" placeholder="0.00" name="valor2">
                </div>

                <!-- Botones de acción -->
                <div class="btn-group" role="group">
                    <button type="reset" class="btn btn-secondary">Borrar</button>
                    <button type="submit" class="btn btn-warning" formaction="sumar.php">sumar</button>
                    <button type="submit" class="btn btn-primary" formaction="restar.php">restar</button>
                    <button type="submit" class="btn btn-success" formaction="multiplicar.php">multiplicar</button>
                    <button type="submit" class="btn btn-danger" formaction="dividir.php">dividir</button>
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