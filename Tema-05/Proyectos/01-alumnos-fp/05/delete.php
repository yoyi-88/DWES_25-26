<?php

/*
    controlador: index.php
    descripción. controlador principal proyecto gestión alumnos
*/


// Configuración base de datos
require_once('config/configDB.php');

// Clases
require_once('class/alumno.class.php');
require_once('class/conexion.class.php');
require_once('class/tabla_alumnos.class.php');

// Modelo
require_once('models/delete.model.php');

// Redireccionoo al controlador index
header('location: index.php');


?>