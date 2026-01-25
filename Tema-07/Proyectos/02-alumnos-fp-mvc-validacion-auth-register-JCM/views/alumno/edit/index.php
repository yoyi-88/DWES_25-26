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
            <form action="<?= URL ?>alumno/update/<?=  $this->id ?>" method="POST">

                <!-- Se exculyen los campos id, poblacion, provincia y dirección por simplicidad -->

                <!-- proetección CSRF -->
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                
                <!-- campo nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control 
                    <?=  (isset($this->errors['nombre'])) ? 'is-invalid': null ?>"
                    name="nombre" 
                    value="<?= htmlspecialchars($this->alumno->nombre)?>"
                    required>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errors['nombre'] ??= null ?>
                    </span>
                </div>

                <!-- campo apellidos -->
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control
                     <?=  (isset($this->errors['apellidos'])) ? 'is-invalid': null ?>"
                    name="apellidos" 
                     value="<?= htmlspecialchars($this->alumno->apellidos)?>"
                    required>
                     <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errors['apellidos'] ??= null ?>
                    </span>
                </div>

                <!-- campo email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control
                    <?=  (isset($this->errors['email'])) ? 'is-invalid': null ?>"
                    name="email" 
                    value="<?= htmlspecialchars($this->alumno->email)?>"
                    required>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errors['email'] ??= null ?>      
                    </span>
                </div>

                <!-- campo dni -->
                <div class="mb-3">
                    <label for="email" class="form-label">DNI:</label>
                    <input type="text" class="form-control
                    <?=  (isset($this->errors['dni'])) ? 'is-invalid': null ?>"
                    name="dni" 
                    value="<?= htmlspecialchars($this->alumno->dni)?>"
                    required>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errors['dni'] ??= null ?>    
                    </span>
                </div>

                <!-- campo teléfono -->
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="tel" class="form-control
                    <?=  (isset($this->errors['telefono'])) ? 'is-invalid': null ?>"
                    name="telefono" 
                    value="<?= htmlspecialchars($this->alumno->telefono)?>"
                    required>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errors['telefono'] ??= null ?>
                    </span>
                </div>

                <!-- campo nacionalidad -->
                <div class="mb-3">
                    <label for="email" class="form-label">Nacionalidad:</label>
                    <input type="text" class="form-control
                    <?=  (isset($this->errors['nacionalidad'])) ? 'is-invalid': null ?>"
                    name="nacionalidad" 
                    value="<?= htmlspecialchars($this->alumno->nacionalidad)?>"
                    required>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errors['nacionalidad'] ??= null ?>   
                    </span>
                </div>

                <!-- campo fecha nacimiento -->
                <div class="mb-3">
                    <label for="fecha_nac" class="form-label">Fecha Nacimiento:</label>
                    <input type="date" class="form-control
                    <?=  (isset($this->errors['fecha_nac'])) ? 'is-invalid': null ?>"
                    name="fecha_nac" 
                    value="<?= htmlspecialchars($this->alumno->fecha_nac) ?>"
                    required>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errors['fecha_nac'] ??= null ?>
                    </span>
                </div>

                <!-- Select Dinámico Cursos -->
                <div class="mb-3">
                    <label for="curso" class="form-label">Cursos:</label>
                    <select class="form-select" name="curso_id" required>
                        <option selected disabled>Seleccione Curso</option>
                        <!-- mostrar lista marcas -->
                        <?php foreach ($this->cursos as $indice => $curso): ?>
                            <option value="<?= $indice ?>"
                                <?= ($this->alumno->curso_id == $indice) ? 'selected' : '' ?>
                            >
                                <?= $curso ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errors['curso_id'] ??= null ?>   
                    </span>
                </div>

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?=  URL ?>alumno" role="button"
                    onclick="return confirm('Confimar cancelar actualización')">Cancelar</a>
                <button type="reset" class="btn btn-secondary" onclick="return confirm('Confimar reseteo artículo')">Limpiar</button>
                <button type="submit" class="btn btn-primary">Actualizar Alumno</button>
            </form>

            <br><br><br>
        </main>

    </div>

    <!-- /.container -->

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>