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

        <!-- Mostrar formulario de editar usuario -->
        <!-- contenido principal -->
        <main>
            <legend><?= $this->title ?></legend>
            <!-- Formulario para editar un usuario -->
            <form action="<?= URL ?>user/update/<?= $this->id ?>" method="POST">

                <!-- protección CSRF -->
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                 
                <!-- campo nombre -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" class="form-control 
                    <?=  (isset($this->errors['name'])) ? 'is-invalid': null ?>"
                    name="name" 
                    value="<?= htmlspecialchars($this->user->name)?>"
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
                    value="<?= htmlspecialchars($this->user->email)?>"
                    required>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errors['email'] ??= null ?>      
                    </span>
                </div>

                <!-- Select Dinámico Roles -->
                <div class="mb-3">
                    <label for="role" class="form-label">Rol:</label>
                    <select class="form-select" name="role_id" required>
                        <option selected disabled>Seleccione Rol</option>
                        <!-- mostrar lista roles -->
                        <?php foreach ($this->roles as $role): ?>
                            <option value="<?= $role->id ?>"
                                <?= ($this->user->role_id == $role->id) ? 'selected' : '' ?>
                            >
                                <?= htmlspecialchars($role->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errors['role_id'] ??= null ?>   
                    </span>
                </div>

                <!-- campo password (opcional) -->
                <div class="mb-3">
                    <label for="password" class="form-label">Nueva Contraseña (dejar en blanco para no cambiar):</label>
                    <input type="password" class="form-control
                    <?=  (isset($this->errors['password'])) ? 'is-invalid': null ?>"
                    name="password" 
                    placeholder="Mínimo 7 caracteres">
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errors['password'] ??= null ?>      
                    </span>
                </div>

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?=  URL ?>user" role="button"
                    onclick="return confirm('Confirmar cancelación')">Cancelar</a>
                <button type="reset" class="btn btn-secondary" onclick="return confirm('Confirmar reseteo formulario')">Limpiar</button>
                <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
            </form>

            <br><br><br>
        </main>

    </div>

    <!-- /.container -->

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>

</html>