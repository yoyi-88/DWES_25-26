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

        <!-- Mostrar tabla de  libros -->
        <!-- contenido principal -->
        <main>
            <legend><?= $this->title ?></legend>

            <!-- Formulario para editar libro -->
            <form action="<?= URL ?>libro/update/<?= $this->id ?>" method="POST">

                <!-- campo titulo -->
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" name="titulo" value="<?= $this->libro->titulo ?>" required>
                </div>

                <!-- Select Dinámico Autores -->
                <div class="mb-3">
                    <label for="autor_id" class="form-label">Autor:</label>
                    <select class="form-select" name="autor_id" required>
                        <option selected disabled value="">Seleccione Autor</option>

                        <?php foreach ($this->autores as $indice => $autor): ?>
                            <option value="<?= $indice ?>"
                                <?= ($this->libro->autor_id == $indice) ? 'selected' : null ?>>
                                <?= $autor ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Select Dinámico Editoriales -->
                <div class="mb-3">
                    <label for="editorial_id" class="form-label">Editorial:</label>
                    <select class="form-select" name="editorial_id" required>
                        <option selected disabled value="">Seleccione Editorial</option>
                        <!-- mostrar lista marcas -->
                        <?php foreach ($this->editoriales as $indice => $editorial): ?>
                            <option value="<?= $indice ?>"
                                <?= ($this->libro->editorial_id == $indice) ? 'selected' : null ?>>
                                <?= $editorial ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- campo precio_venta -->
                <div class="mb-3">
                    <label for="precio_venta" class="form-label">Precio:</label>
                    <input type="number" class="form-control" name="precio_venta" value="<?= $this->libro->precio_venta ?>" required>
                </div>

                <!-- campo stock -->
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock:</label>
                    <input type="number" class="form-control" name="stock" value="<?= $this->libro->stock ?>" required>
                </div>

                <!-- lista dinamica chackbox temas -->
                <div class="mb-3">
                    <label class="form-label">Géneros:</label>
                    <div class="form-check" name="generos">

                        <?php
                        // Recuperamos las variables para simplificar el código
                        $generos = $this->generos;
                        $temas_asignados = $this->temas_libros;
                        ?>

                        <?php foreach ($generos as $indice => $genero): ?>
                            <?php
                            // Lógica clave: Comprobar si el ID del género ($indice) está en la lista de temas asignados
                            $checked = in_array($indice, $temas_asignados) ? 'checked' : null;
                            ?>

                            <div>
                                <input class="form-check-input" type="checkbox" name="genero[]" value="<?= $indice ?>" id="tema_<?= $indice ?>" <?= $checked ?>>
                                <label class="form-check-label" for="tema_<?= $indice ?>">
                                    <?= $genero ?>
                                </label>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

                

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>libro" role="button"
                    onclick="return confirm('Confimar cancelar actualización')">Cancelar</a>
                <button type="reset" class="btn btn-secondary" onclick="return confirm('Confimar reseteo libro')">Limpiar</button>
                <button type="submit" class="btn btn-primary">Actualizar libro</button>
            </form>

            <br><br><br>
        </main>

    </div>

    <!-- /.container -->

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>