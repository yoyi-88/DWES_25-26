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

        <!-- Mostrar formulario de nuevo usuario -->
        <!-- contenido principal -->
        <main>
            <legend>Formulario Nuevo Usuario</legend>
            <!-- Formulario para crear un nuevo usuario -->
            <form action="<?= URL ?>user/create" method="POST">

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

                <!-- campo password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control
                    <?=  (isset($this->errors['password'])) ? 'is-invalid': null ?>"
                    name="password" 
                    required>
                    <!-- mostrar posibles errores de validación -->
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errors['password'] ??= null ?>      
                    </span>
                </div>

                <!-- campo confirmar password -->
                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Confirmar Contraseña:</label>
                    <input type="password" class="form-control
                    <?=  (isset($this->errors['password'])) ? 'is-invalid': null ?>"
                    name="password_confirm" 
                    required>
                </div>

                

                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?=  URL ?>user" role="button"
                    onclick="return confirm('Confirmar cancelación')">Cancelar</a>
                <button type="reset" class="btn btn-secondary" onclick="return confirm('Confirmar reseteo formulario')">Limpiar</button>
                <button type="submit" class="btn btn-primary">Guardar Usuario</button>
            </form>

            <br><br><br>
        </main>

    </div>

    <!-- /.container -->

    <?php require_once("template/partials/footer.partial.php") ?>
    <?php require_once("template/layouts/javascript.layout.php") ?>

</body>

</html>