<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Cargar bootstrap -->
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title> Proyecto 5.2 - Panel Control de Libros - GESLIBROS </title>
</head>

<body>

    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php require_once 'views/partials/header.partial.php'; ?>

        <!-- contenido principal -->
        <main>
            <!-- Formulario añadir nuevo libro -->
            <legend>Formulario Nueva Cuenta</legend>
            <form action="create.php" method="POST">

                <div class="form-group">
                    <label for="id_cliente">Cliente Propietario:</label>
                    <select class="form-control" name="id_cliente" id="id_cliente" required>
                        <option value="">-- Seleccione un Cliente --</option>
                        <?php foreach ($clientes as $id => $nombre_completo): ?>
                            <option value="<?= $id ?>">
                                <?= $nombre_completo ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="num_cuenta">Número de Cuenta (20 dígitos):</label>
                    <input type="text" class="form-control" name="num_cuenta" id="num_cuenta"
                        minlength="0" maxlength="20" required>
                </div>

                <div class="form-group">
                    <label for="saldo_inicial">Saldo Inicial:</label>
                    <input type="number" class="form-control" name="saldo_inicial" id="saldo_inicial"
                        step="0.01" min="0.00" value="0.00" required>
                </div>

                <div class="form-group">
                    <label for="concepto_inicial">Concepto (Apertura):</label>
                    <input type="text" class="form-control" name="concepto_inicial" id="concepto_inicial"
                        value="Apertura de cuenta">
                </div>

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="index.php" role="button"
                    onclick="return confirm('Confimar cancelación libro')">Cancelar</a>
                <button type="reset" class="btn btn-secondary" onclick="return confirm('Confimar reseteo libro')">Limpiar</button>
                <button type="submit" class="btn btn-primary">Guardar Libro</button>
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