<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once("template/partials/menu.principal.partial.php") ?>

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
            <legend>Formulario de Contacto</legend>
            <!-- Formulario para crear un nuevo alumno -->
            <form action="<?= URL ?>contact/validate" method="POST">

                <!-- Se exculyen los campos id, poblacion, provincia y dirección por simplicidad -->

                <!-- proetección CSRF -->
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                
                <!-- campo nombre -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" class="form-control 
                    <?=  (isset($this->errors['name'])) ? 'is-invalid': null ?>"
                    name="name" 
                    value="<?= htmlspecialchars($this->contact->name)?>"
                    required>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errors['name'] ??= null ?>
                    </span>
                </div>

                <!-- campo email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control
                    <?=  (isset($this->errors['email'])) ? 'is-invalid': null ?>"
                    name="email" 
                    value="<?= htmlspecialchars($this->contact->email)?>"
                    required>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errors['email'] ??= null ?>      
                    </span>
                </div>

                <!-- campo mensaje -->
                <div class="mb-3">
                    <label for="mensaje" class="form-label">Mensaje:</label>
                    <textarea class="form-control
                    <?=  (isset($this->errors['mensaje'])) ? 'is-invalid': null ?>"
                    name="mensaje" 
                    required><?= htmlspecialchars($this->contact->message)?></textarea>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errors['mensaje'] ??= null ?>
                    </span>
                </div>

                <!-- campo asunto -->
                <div class="mb-3">
                    <label for="asunto" class="form-label">Asunto:</label>
                    <input type="text" class="form-control
                    <?=  (isset($this->errors['asunto'])) ? 'is-invalid': null ?>"
                    name="asunto" 
                    value="<?= htmlspecialchars($this->contact->subject)?>"
                    required>
                     <!-- mostrar posibles errores de validación -->
                     <span class="form-text text-danger" role="alert">
                            <?= $this->errors['asunto'] ??= null ?>
                     </span>
                </div>

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?=  URL ?>alumno" role="button"
                    onclick="return confirm('Confimar cancelación artículo')">Cancelar</a>
                <button type="reset" class="btn btn-secondary" onclick="return confirm('Confimar reseteo artículo')">Limpiar</button>
                <button type="submit" class="btn btn-primary">Guardar Alumno</button>
            </form>

            <br><br><br>
        </main>

    </div>

    <!-- /.container -->

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>