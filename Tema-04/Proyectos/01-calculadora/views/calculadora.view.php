<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto 4.1 - Calculadora con class</title>

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
            <span class="fs-6">Proyecto 4.1 - Calculadora con class</span>
        </header>

        <!-- contenido principal -->
        <main>
            <h2>Calculadora básica</h2>


            <!--Formulario de la calculadora -->
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Valor 1</label>
                <input type="number" class="form-control" id="valor1" name="valor1" value=<?= $calculadora->getValor1() ?> readonly>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Valor 2</label>
                <input type="number" class="form-control" id="valor2" name="valor2" value=<?= $calculadora->getValor2() ?> readonly>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Operación</label>
                <input type="text" class="form-control" id="operacion" name="operacion" value=<?= $calculadora->getOperacion() ?> readonly>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Resultado</label>
                <input type="number" class="form-control" id="resultado" name="resultado" value=<?= $calculadora->getResultado() ?> readonly>
            </div>

            <a href="index.php" class="btn btn-primary">Volver</a>





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