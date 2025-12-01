<?php

/*
    controlador: delete.php
    descripción. controlador eliminar libro
*/


// Configuración base de datos
require_once('config/configDB.php');

// Clases
require_once('class/libro.class.php');
require_once('class/conexion.class.php');
require_once('class/tabla_libros.class.php');

// Modelo
require_once('models/delete.model.php');

// Redirecciono al controlador index
require_once('views/index.view.php');

?>