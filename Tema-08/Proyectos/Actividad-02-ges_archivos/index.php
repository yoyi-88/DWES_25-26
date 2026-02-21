<?php session_start(); ?>
<!doctype html>
<html lang="es"> 
<?php require_once("template/partials/head.php") ?>
<body>
    <?php require_once("template/partials/menu.php") ?>
    
    <div class="container mt-5">
        <br><br><br>
        <div class="jumbotron text-center bg-light p-5 rounded">
            <h1 class="display-4">Bienvenido a mi Drive PHP</h1>
            <p class="lead">Esta es la página de inicio (Home).</p>
            <hr class="my-4">
            <p>Accede a tus carpetas y archivos o sube nuevos documentos.</p>
            <a class="btn btn-primary btn-lg" href="gestor.php" role="button">Ir al Gestor de Archivos</a>
        </div>
    </div>
    
    <?php require_once("template/partials/footer.php") ?>
    <?php require_once("template/partials/javascript.php") ?>
</body>
</html>