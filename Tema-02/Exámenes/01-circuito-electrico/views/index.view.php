<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXAMEN PRÁCTICO: “CÁLCULO DE CIRCUITO ELÉCTRICO EN CORRIENTE CONTINUA”</title>

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
            <i class="bi bi-lightbulb-fill"></i>
            <span class="fs-3">Cálculo de circuito eléctrico en corriente continua</span>
        </header>

        <!-- contenido principal -->
        <main>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label" for="tension">Tensión</label>
                    <input type="number" class="form-control" name="tension" step="0.01" placeholder="0,00"
                    aria-describedby="helpId" required>
                    <small id="helpId" class="text-muted">(Voltios, V)</small>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="resElec">Resistencia eléctrica</label>
                    <input type="number" class="form-control" name="resElec" step="0.01" placeholder="0,00"
                    aria-describedby="helpId" required>
                    <small id="helpId" class="text-muted">(Ohmios, Ω)</small>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="resElec">Tiempo</label>
                    <input type="number" class="form-control" name="tiempo" step="0.01" placeholder="0,00"
                    aria-describedby="helpId" required>
                    <small id="helpId" class="text-muted">(Segundos, s)</small>
                </div>
                

                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="reset" class="btn btn-secondary">Limpiar</button>
                    <button type="submit" class="btn btn-warning" formaction="calculos.php">Calcular</button>
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