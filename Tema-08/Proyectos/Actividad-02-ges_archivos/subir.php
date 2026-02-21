<?php
session_start();
require_once('class/explorador.php');

// Instanciamos el explorador para que se posicione en la carpeta actual del usuario
if (isset($_SESSION['actual'])) {
    $explorar = new Explorador("raiz", $_SESSION['actual']);
} else {
    $explorar = new Explorador("raiz", "raiz");
    $_SESSION['actual'] = "raiz";
}

$errores = [];
$usuario = $_POST['usuario'] ?? '';
$email = $_POST['email'] ?? '';
$mensaje_exito = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Validaciones de los campos de texto
    if (empty(trim($usuario))) {
        $errores[] = "El campo 'usuario' es obligatorio.";
    }
    if (empty(trim($email)) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Debe introducir un 'email' válido.";
    }

    // Validación del archivo
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] !== UPLOAD_ERR_NO_FILE) {
        $archivo = $_FILES['archivo'];

        // Comprobación de errores de tamaño
        if ($archivo['error'] === UPLOAD_ERR_INI_SIZE) {
            $errores[] = "El archivo supera los 40MB permitidos por el servidor.";
        } elseif ($archivo['error'] === UPLOAD_ERR_FORM_SIZE) {
            $errores[] = "El archivo supera los 2MB permitidos por el formulario.";
        } elseif ($archivo['error'] !== UPLOAD_ERR_OK) {
            $errores[] = "Error inesperado al subir el archivo (Código: " . $archivo['error'] . ").";
        } else {
            // Validar tipos de archivo (MIME y extensión)
            $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];
            $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
            
            $ext = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $archivo['tmp_name']);
            finfo_close($finfo);

            if (!in_array($mime, $tipos_permitidos) || !in_array($ext, $extensiones_permitidas)) {
                $errores[] = "Tipo de archivo no válido. Solo se permiten JPG, PNG y GIF.";
            }

            // Si pasa todas las validaciones, lo guardamos usando tu método
            if (empty($errores)) {
                // Al llamar a este método de tu clase, se guarda en el directorio actual (fijado por el constructor)
                $explorar->subirArchivo($archivo);
                $mensaje_exito = "Archivo subido correctamente en: " . basename($explorar->getDirActual());
                
                // Limpiamos los campos del formulario tras el éxito
                $usuario = '';
                $email = '';
            }
        }
    } else {
        $errores[] = "Debe seleccionar un archivo para subir.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<?php include 'template/partials/head.php'; ?>
<body>
    <?php include 'template/partials/menu.php'; ?>

    <div class="container mt-5">
        <br><br><br>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Subir archivo a: <strong><?= basename($explorar->getDirActual()); ?></strong></span>
                <a href="gestor.php" class="btn btn-sm btn-secondary">Volver al Gestor</a>
            </div>
            <div class="card-body">

                <?php if (!empty($errores)): ?>
                    <div class="alert alert-danger">
                        <strong>Errores en el formulario:</strong>
                        <ul>
                            <?php foreach ($errores as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if ($mensaje_exito): ?>
                    <div class="alert alert-success">
                        <?= htmlspecialchars($mensaje_exito) ?>
                    </div>
                <?php endif; ?>

                <form action="subir.php" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />

                    <div class="form-group mb-3">
                        <label for="usuario">Usuario:</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" value="<?= htmlspecialchars($usuario) ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($email) ?>">
                    </div>

                    <div class="form-group mb-4">
                        <label for="archivo">Archivo (JPG, PNG, GIF - Máx 2MB):</label>
                        <input type="file" name="archivo" id="archivo" class="form-control-file mt-2" accept=".jpg, .jpeg, .png, .gif">
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="material-icons align-middle">publish</i> Subir Archivo</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'template/partials/footer.php'; ?>
    <?php include 'template/partials/javascript.php'; ?>
</body>
</html>