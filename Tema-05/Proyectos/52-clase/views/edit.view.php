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
            <legend>Formulario Editar Cliente</legend>
            <form action="update.php?id=<?= $cliente_id ?>" method="POST">

                
                <!-- campo id
                <div class="mb-3">
                    <label for="id" class="form-label">ID:</label>
                    <input type="number" class="form-control" id="id" name="id" required>
                </div> -->

                <!-- campo apellidos -->
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" value="<?= $cliente->apellidos ?>" required>
                </div>

                <!-- campo nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="<?= $cliente->nombre ?>" required>
                </div>

                <!-- campo telefono -->
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" value="<?= $cliente->telefono ?>" required>
                </div>

                <!-- campo ciudad -->
                <div class="mb-3">
                    <label for="ciudad" class="form-label">Ciudad:</label>
                    <input type="text" class="form-control" name="ciudad" value="<?= $cliente->ciudad ?>" required>
                </div>

                <!-- campo dni -->
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI:</label>
                    <input type="text" class="form-control" name="dni" value="<?= $cliente->dni ?>" required>
                </div>

                <!-- campo email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?= $cliente->email ?>" required>
                </div>

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="index.php" role="button"  
                onclick="return confirm('Confimar cancelación cliente')">Cancelar</a>
                <button type="reset" class="btn btn-secondary"  onclick="return confirm('Confimar reseteo cliente')">Limpiar</button>
                <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
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