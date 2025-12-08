<?php

/*
    controlador: create.php
    descripción. controlador para añadir un nuevo cliente a partir del formulario
*/

// Configuración base de datos
require_once('config/configDB.php');


// Clases
require_once('class/cliente.class.php');
require_once('class/conexion.class.php');
require_once('class/tabla_clientes.class.php');

// Modelo
require_once('models/create.model.php');

// Cargo controlador index mediante redirección
require_once('views/index.view.php');

?>