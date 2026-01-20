<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once("template/partials/menu.partial.php") ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <!-- capa de mensajes -->
        <?php require_once("template/partials/mensaje.partial.php") ?>

        <!-- capa de errores -->
        <?php require_once("template/partials/error.partial.php") ?>

        <!-- Mostrar tabla de  alumnos -->
        <!-- contenido principal -->
        <main>
            <legend><?=  $this->title ?></legend>

            <!-- Formulario para editar alumno -->
            <form>

                <!-- Se exculyen los campos id, poblacion, provincia y dirección por simplicidad -->

                <!-- campo nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="<?= $this->alumno->nombre ?>" disabled>
                </div>

                <!-- campo apellidos -->
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" value="<?= $this->alumno->apellidos ?>" disabled>
                </div>

                <!-- campo email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?= $this->alumno->email ?>" disabled>
                </div>

                <!-- campo dni -->
                <div class="mb-3">
                    <label for="email" class="form-label">DNI:</label>
                    <input type="text" class="form-control" name="dni" value="<?= $this->alumno->dni ?>" disabled>
                </div>

                <!-- campo teléfono -->
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="tel" class="form-control" name="telefono" value="<?= $this->alumno->telefono ?>" disabled>
                </div>

                <!-- campo nacionalidad -->
                <div class="mb-3">
                    <label for="email" class="form-label">Nacionalidad:</label>
                    <input type="text" class="form-control" name="nacionalidad" value="<?= $this->alumno->nacionalidad ?>" disabled>
                </div>

                <!-- campo fecha nacimiento -->
                <div class="mb-3">
                    <label for="fecha_nac" class="form-label">Fecha Nacimiento:</label>
                    <input type="date" class="form-control" name="fecha_nac" value="<?= $this->alumno->fecha_nac ?>" disabled>
                </div>

                <!-- Select Dinámico Cursos -->
                <!-- campo nacionalidad -->
                <div class="mb-3">
                    <label for="email" class="form-label">Curso:</label>
                    <input type="text" class="form-control" name="curso" value="<?= $this->alumno->curso ?>" disabled>
                </div>

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?=  URL ?>alumno" role="button">Volver</a>
            </form>

            <br><br><br>
        </main>

    </div>

    <!-- /.container -->

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>