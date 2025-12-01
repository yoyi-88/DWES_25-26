<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Cargar bootstrap -->
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title> Proyecto 5.2 - Panel Control de Clientes - GESBANK  </title>
</head>

<body>

    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php require_once 'views/partials/header.partial.php'; ?>

        <!-- contenido principal -->
        <main>
            <!-- Formulario añadir nuevo libro -->
            <legend>Formulario Nuevo Cliente</legend>
            <form action="create.php" method="POST">

                <!-- campo apellidos -->
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" required>
                </div>

                <!-- campo nombre  -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>

                <!-- precio venta -->
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="tel" class="form-control" name="telefono" required>
                </div>

                <!-- campo stock -->
                <div class="mb-3">
                    <label for="ciudad" class="form-label">Ciudad:</label>
                    <input type="text" class="form-control" name="ciudad" required>
                </div>

                <!-- campo fecha edición -->
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI:</label>
                    <input type="text" class="form-control" name="dni" required>
                </div>
                
                <!-- Select email -->
                <div class="mb-3">  
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="index.php" role="button"  
                onclick="return confirm('Confimar cancelación cliente')">Cancelar</a>
                <button type="reset" class="btn btn-secondary"  onclick="return confirm('Confimar reseteo cliente')">Limpiar</button>
                <button type="submit" class="btn btn-primary">Guardar Cliente</button>
            </form>

            <br>
            <br>
            <br>
        </main>
        <!-- pie de página -->
        <?php require_once 'views/partials/footer.partial.php'; ?>

        <!-- javaScript bootstrap 5.3.8 -->
        <?php require_once 'views/layouts/js_bootstrap.layout.php'; ?>
</body>

</html>