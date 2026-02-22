<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
</head>

<body>
    <?php require_once("template/partials/menu.partial.php") ?>

    <div class="container">
        <br><br><br><br>

        <?php require_once("template/partials/mensaje.partial.php") ?>
        <?php require_once("template/partials/error.partial.php") ?>

        <main>
            <legend><?= $this->title ?></legend>

            <form action="<?= URL ?>album/uploadImages/<?= $this->id ?>" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                
                <input type="hidden" name="MAX_FILE_SIZE" value="5242880" />

                <div class="mb-3">
                    <label for="imagenes" class="form-label">Seleccionar imágenes (JPG, PNG, GIF):</label>
                    <input type="file" class="form-control" name="imagenes[]" id="imagenes" accept="image/jpeg, image/png, image/gif" multiple required>
                    <div class="form-text">Puedes seleccionar varios archivos a la vez. Tamaño máximo por archivo: 5MB.</div>
                </div>

                <a class="btn btn-secondary" href="<?= URL ?>album" role="button">Cancelar</a>
                <button type="submit" class="btn btn-primary">Subir imágenes</button>
            </form>

        </main>
    </div>

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>
</html>