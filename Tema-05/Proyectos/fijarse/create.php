<?php

/*
    controlador: create.php
    descripción. controlador para añadir un nuevo libro a partir del formulario
*/

// Configuración base de datos
require_once('config/configDB.php');


// Clases
require_once('class/cuenta.class.php');
require_once('class/conexion.class.php');
require_once('class/tabla_cuentas.class.php');

// Modelo
require_once('models/create.model.php');

// Cargo controlador index mediante redirección
require_once('views/index.view.php');

?>