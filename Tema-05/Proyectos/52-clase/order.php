<?php

/*
    controlador: order.php
    descripción. Controlador para ordenar la tabla de clientes por diferentes columnas que se 
    muestran en la vista principal
*/

// Configuración base de datos
require_once('config/configDB.php');

// Clases
require_once('class/cliente.class.php');
require_once('class/conexion.class.php');
require_once('class/tabla_clientes.class.php');

// Modelo
require_once('models/order.model.php');

// Vista
require_once('views/index.view.php');

?>