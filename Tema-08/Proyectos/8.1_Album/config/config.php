<?php
# Configuración básica aplicación MVC

# Ruta absoluta del proyecto
define('URL', 'https://localhost/DWES/tema-08/Proyectos/8.1_Album/');


# Constantes de configuración de la aplicación
define('APP_NAME', 'Gestión Album de fotos');
define('APP_VERSION', '2.0.0');
define('APP_AUTHOR', 'Yoël Gómez Benítez');
define('CURSO', '25/26');

# Rutas de los componentes MVC
define('CONTROLLER_PATH', 'controllers/');
define('MODEL_PATH', 'models/');
define('VIEW_PATH', 'views/');
define('DEFAULT_CONTROLLER', 'main');
define('ERROR_CONTROLLER', 'error');

# Constante de la Base de Datos
define('HOST', 'localhost');
define('DB', 'album');
define('USER', 'root');
define('PASSWORD', '');
define('CHARSET', 'utf8mb4');


?>