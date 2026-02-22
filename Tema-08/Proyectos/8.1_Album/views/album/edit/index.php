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

        <!-- Mostrar tabla de  albums -->
        <!-- contenido principal -->
        <main>
            <legend><?=  $this->title ?></legend>

            <!-- Formulario para editar album -->
            <form action="<?= URL ?>album/update/<?=  $this->id ?>" method="POST">


                <!-- proetección CSRF -->
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                
                <!-- campo nombre -->
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control 
                    <?=  (isset($this->errors['titulo'])) ? 'is-invalid': null ?>"
                    name="titulo" 
                    value="<?= htmlspecialchars($this->album->titulo)?>"
                    required>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errors['titulo'] ??= null ?>
                    </span>
                </div>

                <!-- campo apellidos -->
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" class="form-control
                     <?=  (isset($this->errors['descripcion'])) ? 'is-invalid': null ?>"
                    name="descripcion" 
                     value="<?= htmlspecialchars($this->album->descripcion)?>"
                    required>
                     <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errors['descripcion'] ??= null ?>
                    </span>
                </div>

                <!-- campo email -->
                <div class="mb-3">
                    <label for="autor" class="form-label">Autor:</label>
                    <input type="text" class="form-control
                    <?=  (isset($this->errors['autor'])) ? 'is-invalid': null ?>"
                    name="autor" 
                    value="<?= htmlspecialchars($this->album->autor)?>"
                    required>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errors['autor'] ??= null ?>      
                    </span>
                </div>

                <!-- campo dni -->
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" class="form-control
                    <?=  (isset($this->errors['fecha'])) ? 'is-invalid': null ?>"
                    name="fecha" 
                    value="<?= htmlspecialchars($this->album->fecha)?>"
                    required>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errors['fecha'] ??= null ?>    
                    </span>
                </div>

                <!-- campo teléfono -->
                <div class="mb-3">
                    <label for="etiquetas" class="form-label">Etiquetas:</label>
                    <input type="text" class="form-control
                    <?=  (isset($this->errors['etiquetas'])) ? 'is-invalid': null ?>"
                    name="etiquetas" 
                    value="<?= htmlspecialchars($this->album->etiquetas)?>"
                    required>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errors['etiquetas'] ??= null ?>
                    </span>
                </div>

                
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?=  URL ?>album" role="button"
                    onclick="return confirm('Confimar cancelar actualización')">Cancelar</a>
                <button type="reset" class="btn btn-secondary" onclick="return confirm('Confimar reseteo artículo')">Limpiar</button>
                <button type="submit" class="btn btn-primary">Actualizar album</button>
            </form>

            <br><br><br>
        </main>

    </div>

    <!-- /.container -->

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>