<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Cargar bootstrap -->
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title>  Proyecto 5.3 - PANEL CONTROL DE LIBROS</title>
</head>

<body>

    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php require_once 'views/partials/header.partial.php'; ?>

        <!-- contenido principal -->
        <main>
            <!-- Formulario añadir nuevo libro -->
            <legend>Formulario Nuevo Libro</legend>
            <form action="create.php" method="POST">

                <!-- Se exculyen los campos id, poblacion, provincia y dirección por simplicidad -->
                <!-- campo id
                <div class="mb-3">
                    <label for="id" class="form-label">ID:</label>
                    <input type="number" class="form-control" id="id" name="id" required>
                </div> -->

                <!-- campo titulo -->
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" name="titulo" required>
                </div>

                <!-- campo isbn -->
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN:</label>
                    <input type="text" class="form-control" name="isbn" required>
                </div>

                <!-- campo precio_venta -->
                <div class="mb-3">
                    <label for="precio_venta" class="form-label">Precio venta:</label>
                    <input type="number" step="0.01" class="form-control" name="precio_venta" placeholder="0.00"required>
                </div>

                <!-- campo stock -->
                <div class="mb-3">
                    <label for="stock" class="form-label">Unidades:</label>
                    <input type="number" class="form-control" step="0" name="stock" required>
                </div>

                <!-- fecha edicion -->
                <div class="mb-3">
                    <label for="fecha_edicion" class="form-label">Fecha de edición:</label>
                    <input type="date" class="form-control" name="fecha_edicion" required>
                </div>

                <!-- Select Dinámico Autores -->
                <div class="mb-3">
                    <label for="autor_id" class="form-label">Autores:</label>
                    <select class="form-select" name="autor_id" required>
                        <option selected disabled value="">Seleccione Autor</option>
                        <!-- mostrar lista marcas -->
                        <?php foreach ($autores as $indice=>$autor): ?>
                            <option value="<?= $indice ?>">
                                <?= $autor ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Select Dinámico Editoriales -->
                <div class="mb-3">
                    <label for="editorial_id" class="form-label">Editoriales:</label>
                    <select class="form-select" name="editorial_id" required>
                        <option selected disabled value="">Seleccione Editorial</option>
                        <!-- mostrar lista marcas -->
                        <?php foreach ($editoriales as $indice=>$editorial): ?>
                            <option value="<?= $indice ?>">
                                <?= $editorial ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- lista dinamica chackbox temas -->
                <div class="mb-3">
                    <label class="form-label">Géneros:</label>
                    <div class="form-check">
                        <!-- mostrar lista temas -->
                        <?php foreach ($generos as $indice=>$genero): ?>
                            <div>
                                <input class="form-check-input" type="checkbox" name="genero[]" value="<?= $indice ?>" id="tema_<?= $indice ?>">
                                <label class="form-check-label" for="tema_<?= $indice ?>">
                                    <?= $genero ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="index.php" role="button"  
                onclick="return confirm('Confimar cancelación libro')">Cancelar</a>
                <button type="reset" class="btn btn-secondary"  onclick="return confirm('Confimar reseteo libro')">Limpiar</button>
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