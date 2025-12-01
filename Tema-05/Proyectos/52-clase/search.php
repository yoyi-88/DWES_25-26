<?php

/*
    controlador: search.php
    descripción. controlador de búsqueda y filtrado libros

    Necesito: Activar el campo búsqueda del menú 

    Método GET:
    
        - prompt: cadena de búsqueda
*/

// Configuración base de datos
require_once('config/configDB.php');

// Clases
require_once('class/cliente.class.php');
require_once('class/conexion.class.php');
require_once('class/tabla_clientes.class.php');

// Modelo
require_once('models/search.model.php');

// Vista
require_once('views/index.view.php');

?>