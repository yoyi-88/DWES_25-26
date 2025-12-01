<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Cargar bootstrap -->
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title>  Proyecto 5.1 - CRUD Gestión Alumnos PHP y MySQL</title>
</head>

<body>

    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php require_once 'views/partials/header.partial.php'; ?>

        <!-- contenido principal -->
        <main>
            <!-- Formulario añadir nuevo libro -->
            <legend>Formulario Edición Libro</legend>
            <form action="update.php?id=<?=  $libro->id ?>" method="POST">

                <!-- Se exculyen los campos id, poblacion, provincia y dirección por simplicidad -->
                <!-- campo id
                <div class="mb-3">
                    <label for="id" class="form-label">ID:</label>
                    <input type="number" class="form-control" id="id" name="id" required>
                </div> -->

                <!-- campo nombre -->
                <div class="mb-3">
                    <label for="isbn" class="form-label">Isbn:</label>
                    <input type="text" class="form-control" name="isbn" value="<?=  $libro->isbn ?>" required>
                </div>

                <!-- campo apellidos -->
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" value="<?=  $libro->apellidos ?>" required>
                </div>

                <!-- campo email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?=  $alumno->email ?>" required>
                </div>

                <!-- campo dni -->
                <div class="mb-3">
                    <label for="email" class="form-label">DNI:</label>
                    <input type="text" class="form-control" name="dni" value="<?=  $alumno->dni ?>" required>
                </div>

                <!-- campo teléfono -->
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="tel" class="form-control" name="telefono" value="<?=  $alumno->telefono ?>" required>
                </div>

                <!-- campo nacionalidad -->
                <div class="mb-3">
                    <label for="email" class="form-label">Nacionalidad:</label>
                    <input type="text" class="form-control" name="nacionalidad" value="<?=  $alumno->nacionalidad ?>" required>
                </div>

                <!-- campo fecha nacimiento -->
                <div class="mb-3">
                    <label for="fecha_nac" class="form-label">Fecha Nacimiento:</label>
                    <input type="date" class="form-control" name="fecha_nac" value="<?=  $alumno->fecha_nac ?>" required>
                </div>


                <!-- Select Dinámico autores -->
                <div class="mb-3">
                    <label for="autor" class="form-label">Autores:</label>
                    <select class="form-select" name="autor_id" required>
                        <option selected disabled>Seleccione Autor</option>
                        <!-- mostrar lista marcas -->
                        <?php foreach ($autores as $indice => $autor): ?>
                            <option value="<?= $indice ?>"
                                <?= ($libro->autor_id == $indice) ? 'selected' : null ?>>
                                <?= $autor_nombre ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                
                

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="index.php" role="button"  
                onclick="return confirm('Confimar cancelación libro')">Cancelar</a>
                <button type="reset" class="btn btn-secondary"  onclick="return confirm('Confimar reseteo libro')">Limpiar</button>
                <button type="submit" class="btn btn-primary">Actualizar Libro</button>
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