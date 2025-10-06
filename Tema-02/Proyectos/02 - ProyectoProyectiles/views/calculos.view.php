<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto 2.2 - Cálculo de lanzamiento de proyectiles con PHP</title>

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
            <i class="bi bi-rocket-takeoff-fill"></i>
            <span class="fs-6">Proyecto 2.2 - Cálculo de lanzamiento de proyectiles con PHP</span>
            <p>Resultado</p>
        </header>

        <!-- contenido principal -->
        <main>
            <!-- Formulario de la calculadora básica -->
            <form>
                <!-- Valor 1: -->
                <!-- Velocidad inicial -->
                <div class="mb-3">
                    <label class="form-label" for="velocidadInicial">Velocidad Inicial (m/s):</label>
                    <input type="number" class="form-control" name="velocidadInicial" step="1" placeholder="0"
                    aria-describedby="helpId" readonly>
                    <small id="helpId" class="text-muted">Introduce la velocidad inicial del proyectil en metros por segundo (m/s).</small>
                </div>

                <!-- Ángulo de lanzamiento -->
                <div class="mb-3">
                    <label class="form-label" for="anguloLanzamiento">Ángulo de Lanzamiento (grados):</label>
                    <input type="number" class="form-control" name="anguloLanzamiento" step="1" placeholder="0"
                    aria-describedby="helpId" readonly>
                    <small id="helpId" class="text-muted">Introduce el ángulo de lanzamiento del proyectil en grados.</small>
                <!-- Resultado -->
                 <div class="input-group mb-3">
                    <span class="input-group-text"><?= $operacion ?></span>
                    <input type="number" class="form-control" value="<?= $resultado ?>" step="0.01" readonly>
                </div>

                <!-- Botones de acción -->
                 <div class="btn-group" role="group">
                    <a class="btn btn-secondary" href="index.php" role="button">Nueva operación</a>
    

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