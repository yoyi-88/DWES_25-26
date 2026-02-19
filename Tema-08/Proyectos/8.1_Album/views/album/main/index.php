<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once("template/partials/menu.auth.partial.php") ?>

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
            <legend>Colección de Albumes</legend>
            <!-- Menú principal de gestión de alumnos de FP -->
            <?php require_once("views/album/partials/menu.album.partial.php") ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <!-- cabecera tabla alumnos -->
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Título</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Etiquetas</th>
                            <th scope="col" class="text-end">Imágenes</th>
                            <th scope="col" class="text-end">Visitas</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- $albumes es un objeto mysqli_result, se puede usar foreach directamente  -->
                        <!-- solo cuando cada iteración devuelve un array asociativo -->
                        <?php while ($album = $this->albumes->fetch()): ?>
                            <tr class="">
                                <td><?= $album['id'] ?></td>
                                <td><?= $album['titulo'] ?></td>
                                <td><?= $album['autor'] ?></td>
                                <td><?= $album['fecha'] ?></td>
                                <td><?= $album['etiquetas'] ?></td>
                                <td class="text-end"><?= $album['num_fotos'] ?></td>
                                <td class="text-end"><?= $album['num_visitas']  ?></td>

                                <!-- botones de acción -->
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <!-- boton eliminar -->
                                        <form method="POST" action="<?= URL ?>alumno/delete/<?= $album['id'] ?>" style="display:inline;">
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm 
                                            <?= !in_array($_SESSION['role_id'], $GLOBALS['album']['delete'])? 'disabled':null ?>"
                                            title="Eliminar" onclick="return confirm('Confirmar eliminación del album <?= $album['titulo'] ?>')">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                        <!-- boton editar -->
                                        <a href="<?=  URL ?>alumno/edit/<?= $album['id'] ?>" class="btn btn-warning btn-sm
                                        <?= !in_array($_SESSION['role_id'], $GLOBALS['album']['edit'])? 'disabled':null ?>" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <!-- boton ver -->
                                        <a href="<?=  URL ?>alumno/show/<?= $album['id'] ?>" class="btn btn-primary btn-sm
                                        <?= !in_array($_SESSION['role_id'], $GLOBALS['album']['show'])? 'disabled':null ?>" title="Ver">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </td>


                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">Total Álbumes: <?= $this->albumes->rowCount() ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br><br><br>

        </main>

    </div>

    <!-- /.container -->

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>