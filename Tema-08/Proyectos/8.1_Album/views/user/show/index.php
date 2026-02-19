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

        <!-- Mostrar detalles del usuario -->
        <!-- contenido principal -->
        <main>
            <legend><?= $this->title ?></legend>

            <!-- Formulario para mostrar detalles del usuario -->
            <form>

                <!-- campo nombre -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($this->user->name) ?>" disabled>
                </div>

                <!-- campo email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($this->user->email) ?>" disabled>
                </div>

                <!-- campo rol -->
                <div class="mb-3">
                    <label for="role_name" class="form-label">Rol:</label>
                    <input type="text" class="form-control" name="role_name" value="<?= htmlspecialchars($this->user->role_name) ?>" disabled>
                </div>

                <!-- campo descripción rol -->
                <div class="mb-3">
                    <label for="role_description" class="form-label">Descripción del Rol:</label>
                    <textarea class="form-control" name="role_description" rows="3" disabled><?= htmlspecialchars($this->user->role_description) ?></textarea>
                </div>

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?=  URL ?>user" role="button">Volver</a>
            </form>

            <br><br><br>
        </main>

    </div>

    <!-- /.container -->

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>

</html>