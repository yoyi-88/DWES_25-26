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
            <form action="<?= URL ?>libro/create" method="POST">

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" name="titulo" required>
                </div>

                <div class="mb-3">
                    <label for="autor_id" class="form-label">Autor:</label>
                    <select class="form-select" name="autor_id" required>
                        <option selected disabled value="">Seleccione Autor</option>

                        <?php foreach ($this->autores as $indice => $autor): ?>
                            <option value="<?= $indice ?>">
                                <?= $autor ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="editorial_id" class="form-label">Editorial:</label>
                    <select class="form-select" name="editorial_id" required>
                        <option selected disabled value="">Seleccione Editorial</option>
                        
                        <?php foreach ($this->editoriales as $indice => $editorial): ?>
                            <option value="<?= $indice ?>">
                                <?= $editorial ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="precio_venta" class="form-label">Precio:</label>
                    <input type="number" step="0.01" class="form-control" name="precio_venta" required>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock:</label>
                    <input type="number" class="form-control" name="stock" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Géneros:</label>
                    <div class="form-check"> 

                        <?php
                        // Solo necesitamos los géneros (que se cargan en el controlador new())
                        $generos = $this->generos;
                        // Eliminada la línea de $temas_asignados = $this->temas_libros;
                        ?>

                        <?php foreach ($generos as $indice => $genero): ?>
                            <div>
                                <input class="form-check-input" type="checkbox" name="genero[]" value="<?= $indice ?>" id="tema_<?= $indice ?>">
                                <label class="form-check-label" for="tema_<?= $indice ?>">
                                    <?= $genero ?>
                                </label>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

                <a class="btn btn-secondary" href="<?= URL ?>libro" role="button"
                    onclick="return confirm('Confimar cancelación libro')">Cancelar</a>
                <button type="reset" class="btn btn-secondary" onclick="return confirm('Confimar reseteo libro')">Limpiar</button>
                <button type="submit" class="btn btn-primary">Guardar libro</button>
            </form>

            <br><br><br>
        </main>

    </div>

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>