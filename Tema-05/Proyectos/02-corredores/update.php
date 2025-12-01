<?php

/*
    controlador: create.php
    descripción. controlador para crear nuevos alumnos
*/

// Configuración base de datos
require_once('config/configDB.php');


// Clases
require_once('class/corredor.class.php');
require_once('class/conexion.class.php');
require_once('class/tabla_corredores.class.php');

// Modelo
require_once('models/update.model.php');

// Cargo controlador index mediante redirección
require_once('views/index.view.php');

?>