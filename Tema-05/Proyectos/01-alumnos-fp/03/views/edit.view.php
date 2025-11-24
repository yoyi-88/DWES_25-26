<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title>Proyecto 3.2</title>

</head>

<body>
    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php require_once 'views/partials/header.partial.php'; ?>

        <main>
            <h4>Formulario editar artículo</h4>
            <!-- contenido principal -->
            <form action="update.php?id=<?= $alumno->id ?>" method="POST">  

                <div class="mb-3">
                    <label for="descripcion" class="form-label">ID:</label>
                    <input type="number" class="form-control" id="id" name="id" value="<?= $alumno->id ?>" readonly>
                </div>


                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $alumno->nombre ?>">
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= $alumno->apellidos ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $alumno->email ?>" required>
                </div>

                <div class="mb-3">
                    <label for="nacionalidad" class="form-label">Nacionalidad:</label>
                    <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" value="<?= $alumno->nacionalidad ?>" required>
                </div>

                <div class="mb-3">
                    <label for="dni" class="form-label">DNI:</label>
                    <input type="text" class="form-control" id="dni" name="dni" value="<?= $alumno->dni ?>" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="tel" class="form-control" name="telefono" value="<?=  $alumno->telefono ?>" required>
                </div>

                <div>
                    <label for="fecha_nac" class="form-label">Fecha nacimiento:</label>
                    <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" value="<?= $alumno->fecha_nac ?>" required>
                </div>

                <div class="mb-3">
                    <label for="curso" class="form-label">Cursos:</label>
                    <select class="form-select" name="curso_id" required>
                        <option selected disabled>Seleccione Curso</option>
                        <!-- mostrar lista marcas -->
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?= $curso['id'] ?>"
                                <?= ($curso['id'] == $alumno->curso_id) ? 'selected' : '' ?>>
                                <?= $curso['curso'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="button" class="btn btn-danger mt-3" onclick="window.location.href='index.php'">Cancelar</button>
                <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
                <button type="reset" class="btn btn-secondary mt-3">Limpiar</button>
                

            </form>


        </main>

        <!-- pie de página -->
        <?php require_once 'views/partials/footer.partial.php'; ?>
    </div>
    <!-- javascript bootstrap5.3.8 -->
    <?php require_once 'views/layouts/javascript.php'; ?>
</body>

</html>