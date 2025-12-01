<?php

/*
    controlador: update.php
    descripción. controlador para actualizar los detalles de un libro
    a partir del formulario update.view.php
*/

// Configuración base de datos
require_once('config/configDB.php');


// Clases
require_once('class/cliente.class.php');
require_once('class/conexion.class.php');
require_once('class/tabla_clientes.class.php');

// Modelo
require_once('models/update.model.php');

// Cargo controlador index mediante redirección
require_once('views/index.view.php');

?>