<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actividad 2.1.1 Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>

  <!-- Contenedor principal -->
   <div class="container">

    <p><?php echo "Valor 1 (0): " . (empty($var1) ? "true" : "false"); ?></p>
    <p><?php echo "Valor 2 (''): " . (empty($var2) ? "true" : "false"); ?></p>
    <p><?php echo "Valor 3 (null): " . (empty($var3) ? "true" : "false"); ?></p>
    <p><?php echo "Valor 4 (123): " . (empty($var4) ? "true" : "false"); ?></p>
    <p><?php echo "Valor 5 ('Hola'): " . (empty($var5) ? "true" : "false"); ?></p>
    <p><?php echo "Valor 6 ([1,2,3]): " . (empty($var6) ? "true" : "false"); ?></p>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>