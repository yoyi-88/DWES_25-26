<?php

/*
    controlador: edit.php
    descripción. controlador para editar alumnos
*/


// Configuración base de datos
require_once('config/configDB.php');

// Clases
require_once('class/alumno.class.php');
require_once('class/conexion.class.php');
require_once('class/tabla_alumnos.class.php');

// Modelo
require_once('models/edit.model.php');

// Vista
require_once('views/edit.view.php');

?>