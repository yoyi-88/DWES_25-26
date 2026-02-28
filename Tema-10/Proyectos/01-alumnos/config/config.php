<?php
# Configuración básica aplicación MVC

# Ruta absoluta del proyecto
define('URL', 'http://localhost/DWES/tema-10/Proyectos/01-alumnos/');


# Constantes de configuración de la aplicación
define('APP_NAME', 'Gestión Alumnos FP');
define('APP_VERSION', '1.0.0');
define('APP_AUTHOR', 'Juan Carlos Moreno');

# Rutas de los componentes MVC
define('CONTROLLER_PATH', 'controllers/');
define('MODEL_PATH', 'models/');
define('VIEW_PATH', 'views/');
define('DEFAULT_CONTROLLER', 'main');
define('ERROR_CONTROLLER', 'error');

# Constante de la Base de Datos
define('HOST', 'localhost');
define('DB', 'fp');
define('USER', 'root');
define('PASSWORD', '');
define('CHARSET', 'utf8mb4');


?>