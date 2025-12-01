<?php

/*
    controlador: new.php
    descripción. Controlador para la creación de un nuevo alumno
*/


// Configuración base de datos
require_once('config/configDB.php');

// Clases
require_once('class/cliente.class.php');
require_once('class/conexion.class.php');
require_once('class/tabla_clientes.class.php');

// Modelo
require_once('models/new.model.php');

// Vista
require_once('views/new.view.php');

?>