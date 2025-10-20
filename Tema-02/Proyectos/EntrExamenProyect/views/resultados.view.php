<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>entrenamiento proyectiles</title>

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
            <span class="fs-1">Lanzamiento de proyectiles</span>
            <p>Examen practico noseque</p>
        </header>

        <!-- contenido principal -->
        <main>
            <form>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Valores iniciales</th>
                        </tr>
                        <tr>
                            <td>Velocidad inicial:</td>
                            <td><?=$velIn?></td>
                        </tr>
                        <tr>
                            <td>Angulo Inclinacion:</td>
                            <td><?=$angulo?></td>
                        </tr>
                    </tbody>
                </table>

                <table class="table">
                    <tbody>
                        <tr>
                            <th>Resultados</th>
                        </tr>
                        <tr>
                            <td>Velocidad inicial horizontal:</td>
                            <td><?=$v0x?> m/s</td>
                        </tr>
                        <tr>
                            <td>Velocidad inicial vertical:</td>
                            <td><?=$v0y?></td>
                        </tr>
                        <tr>
                            <td>Angulo Inclinacion:</td>
                            <td><?=$angRad?></td>
                        </tr>
                    </tbody>
                </table>


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