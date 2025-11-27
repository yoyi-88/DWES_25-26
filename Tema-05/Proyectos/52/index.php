<?php

/*
    controlador: index.php
    descripción. controlador controlador principal de la aplicación

*/

// Configuración base de datos
require_once('config/configDB.php');

// Clases
require_once('class/libro.class.php');
require_once('class/conexion.class.php');
require_once('class/tabla_libros.class.php');

// Modelo
require_once('models/index.model.php');

// Vista
require_once('views/index.view.php');

?>