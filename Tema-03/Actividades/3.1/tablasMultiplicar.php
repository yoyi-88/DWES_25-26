<?php 

    /**
    * Actividad 3.1: Uso de for y if alternativo para mostrar una tabla de multiplicar
    */

    $numeros = 100; // cantidad de números a mostrar
    $columnas = 10;  // cantidad de columnas
    $multiplicacion = array(1,2,3,4,5,6,7,8,9,10);



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas de multiplicar</title>

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
            <i class="bi bi-table"></i>
            <span class="fs-6">Tablas de multiplicar</span>
        </header>

        <!-- contenido principal -->
        <main>

            <table class="table table-info  ">
                <tbody>
                    <?php foreach ($multiplicacion as $multiplicador): ?>

                        <tr>
                            <td><b><?=$multiplicador?></b></td>

                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <td><?= ($multiplicador * $i) ?></td>
                            <?php endfor; ?>
                        </tr>
                        
                    <?php endforeach; ?>
                </tbody>


            </table>
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