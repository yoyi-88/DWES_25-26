<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
    <style>
        /* Pequeño ajuste para que todas las miniaturas tengan el mismo alto */
        .img-thumbnail-album {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php require_once("template/partials/menu.partial.php") ?>

    <div class="container">
        <br><br><br><br>

        <?php require_once("template/partials/mensaje.partial.php") ?>
        <?php require_once("template/partials/error.partial.php") ?>

        <main>
            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-2">
                    <h1 class="display-5 fw-bold"><?= htmlspecialchars($this->album->titulo) ?></h1>
                    <p class="col-md-8 fs-4"><?= htmlspecialchars($this->album->descripcion) ?></p>
                    <ul class="list-inline">
                        <li class="list-inline-item"><strong>Autor:</strong> <?= htmlspecialchars($this->album->autor) ?></li>
                        <li class="list-inline-item"><strong>Fecha:</strong> <?= htmlspecialchars($this->album->fecha) ?></li>
                        <li class="list-inline-item"><strong>Etiquetas:</strong> <?= htmlspecialchars($this->album->etiquetas) ?></li>
                        <li class="list-inline-item"><strong>Visitas:</strong> <?= htmlspecialchars($this->album->num_visitas) ?></li>
                        <li class="list-inline-item"><strong>Fotos:</strong> <?= htmlspecialchars($this->album->num_fotos) ?></li>
                    </ul>
                    <a class="btn btn-secondary" href="<?= URL ?>album" role="button">Volver a la lista</a>
                    
                    <?php if (in_array($_SESSION['role_id'], $GLOBALS['album']['addImages'])): ?>
                        <a class="btn btn-success" href="<?= URL ?>album/addImages/<?= $this->id ?>" role="button">Añadir más fotos</a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                
                <?php if (empty($this->imagenes)): ?>
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            Este álbum aún no tiene imágenes.
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($this->imagenes as $imagen): ?>
                        <div class="col">
                            <div class="card shadow-sm">
                                <img src="<?= URL ?>images/<?= $this->album->carpeta ?>/<?= $imagen ?>" class="bd-placeholder-img card-img-top img-thumbnail-album" alt="<?= $imagen ?>">
                                
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="<?= URL ?>images/<?= $this->album->carpeta ?>/<?= $imagen ?>" target="_blank" class="btn btn-sm btn-outline-primary">Ver</a>
                                            
                                            <?php if (in_array($_SESSION['role_id'], $GLOBALS['album']['edit'])): ?>
                                                <a href="<?= URL ?>album/deleteImage/<?= $this->id ?>?name=<?= urlencode($imagen) ?>" 
                                                   class="btn btn-sm btn-outline-danger"
                                                   onclick="return confirm('¿Estás seguro de que quieres eliminar esta imagen?')">Eliminar</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

            <br><br><br>
        </main>
    </div>

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>
</html>