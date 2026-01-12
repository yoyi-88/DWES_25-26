<?php

/*
    modelo:  index.model.php
    descripción: obtiene los datos de los clientes que luego se mostrarán en la vista
*/

// Realizo la conexión a la base de datos gesbank
$gesbank = new class_tabla_clientes();

// Obtengo todos los clientes de la base de datos
$clientes = $gesbank->get_clientes();
