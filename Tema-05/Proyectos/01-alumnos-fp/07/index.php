<?php

/*
    controlador: filter.php
    descripción. controlador de búsqueda y filtrado de alumnos de FP

    Necesito: Activar el campo búsqueda del menú 
*/

// Configuración base de datos
require_once('config/configDB.php');

// Clases
require_once('class/alumno.class.php');
require_once('class/conexion.class.php');
require_once('class/tabla_alumnos.class.php');

// Modelo
require_once('models/index.model.php');

// Vista
require_once('views/index.view.php');

?>