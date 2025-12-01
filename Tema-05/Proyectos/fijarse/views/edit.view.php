<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Cargar bootstrap -->
    <?php require_once 'views/layouts/head.layout.php'; ?>
    <title> Proyecto 5.2 - Panel Control de Libros - GESLIBROS  </title>
</head>

<body>

    <!-- capa principal -->
    <div class="container mt-3">

        <!-- cabecera del documento -->
        <?php require_once 'views/partials/header.partial.php'; ?>

        <!-- contenido principal -->
        <main>
            <!-- Formulario añadir nuevo libro -->
            <legend>Formulario Editar Libro</legend>
            <form action="update.php?id=<?= $libro_id ?>" method="POST">

                
                <!-- campo id
                <div class="mb-3">
                    <label for="id" class="form-label">ID:</label>
                    <input type="number" class="form-control" id="id" name="id" required>
                </div> -->

                <!-- campo título -->
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" name="titulo" value="<?= $libro->titulo ?>" required>
                </div>

                <!-- campo isbn -->
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN:</label>
                    <input type="text" class="form-control" name="isbn" value="<?= $libro->isbn ?>" required>
                </div>

                <!-- precio venta -->
                <div class="mb-3">
                    <label for="precio_venta" class="form-label">Precio Venta:</label>
                    <input type="number" class="form-control" step="0.00" placeholder="0.00" name="precio_venta" value="<?= $libro->precio_venta ?>" required>
                </div>

                <!-- campo stock -->
                <div class="mb-3">
                    <label for="stock" class="form-label">Unidades:</label>
                    <input type="number" class="form-control" step="0" name="stock" value="<?= $libro->stock ?>" required>
                </div>

                <!-- campo fecha edición -->
                <div class="mb-3">
                    <label for="fecha_edicion" class="form-label">Fecha Edición:</label>
                    <input type="date" class="form-control" name="fecha_edicion" value="<?= $libro->fecha_edicion ?>" required>
                </div>
                
                <!-- Select Dinámico Autores -->
                <div class="mb-3">
                    <label for="curso" class="form-label">Autores:</label>
                    <select class="form-select" name="autor_id" required>
                        <option selected value="">Seleccione Autor</option>
                        <!-- mostrar lista marcas -->
                        <?php foreach ($autores as $indice =>$autor): ?>
                            <option value="<?= $indice ?>"
                            <?= ($libro->autor_id == $indice)? 'selected':null ?>>
                                <?= $autor ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Select Dinámico Editoriales -->
                <div class="mb-3">  
                    <label for="editorial_id" class="form-label">Editoriales:</label>
                    <select class="form-select" name="editorial_id" required>
                        <option selected value="">Seleccione Editorial</option>
                        <!-- mostrar lista marcas -->
                        <?php foreach ($editoriales as $indice =>$editorial): ?>
                            <option value="<?= $indice ?>"
                            <?= ($libro->editorial_id == $indice)? 'selected':null ?>>
                                <?= $editorial ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Lista dinámica de checbox géneros -->
                <div class="mb-3">
                    <label class="form-label">Géneros:</label>
                    <div class="form-check">
                        <!-- mostrar lista géneros -->
                        <?php foreach ($generos as $indice => $genero): ?>
                            <input class="form-check-input" type="checkbox" name="generos_id[]" 
                            value="<?= $indice ?>" id="tema_<?= $indice ?>"
                            <?= (in_array($indice, $libro->generos))? 'checked': null ?>>
                            <label class="form-check-label" for="tema_<?= $indice ?>">
                                <?= $genero ?>      
                            </label><br>
                        <?php endforeach; ?>    
                    </div>
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