<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXAMEN PRÁCTICO: CÁLCULO DE CIRCUITO ELÉCTRICO EN CORRIENTE CONTINUA”</title>

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
            <h2>Datos de entrada:</h2>
            <div class="mb-3">
                    <label class="form-label" for="tension">Tensión</label>
                    <input type="number" class="form-control" value="<?= $tension?>" name="tension" step="0.01"
                    aria-describedby="helpId" readonly>
                    <small id="helpId" class="text-muted">(Voltios, V)</small>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="resElec">Resistencia eléctrica</label>
                    <input type="number" class="form-control" value="<?= $resElec?>" name="resElec" step="0.01"
                    aria-describedby="helpId" readonly>
                    <small id="helpId" class="text-muted">(Ohmios, Ω)</small>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="resElec">Tiempo</label>
                    <input type="number" class="form-control" value="<?= $tiempo?>" name="tiempo" step="0.01"
                    aria-describedby="helpId" readonly>
                    <small id="helpId" class="text-muted">(Segundos, s)</small>
                </div>
            <h2>Resultados:</h2>

            <table class="table table-info">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Magnitud</th>
                        <th scope="col" class="text-end">Valor</th>
                        <th scope="col">Unidad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Corriente</td>
                        <td class="text-end"><?= number_format($intCorr, 2, ',', '') ?></td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Potencia</td>
                        <td class="text-end"><?= number_format($potElec, 2, ',', '') ?></td>
                        <td>W</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Energía en <?= $tiempo ?> segundos</td>
                        <td class="text-end"><?= number_format($enXSeg, 2, ',', '') ?></td>
                        <td>J</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Resistencia equivalente (2 resistencias en paralelo)</td>
                        <td class="text-end"><?= number_format($dosRes, 2, ',', '') ?></td>
                        <td>Ω</td>
                    </tr>
                </tbody>
            </table>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a class="btn btn-secondary" href="index.php" role="button">Volver</a>
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