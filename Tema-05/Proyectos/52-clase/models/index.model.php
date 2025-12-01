<?php

/*
    modelo:  index.model.php
    descripción: obtiene los datos de los libros que luego se mostrarán en la vista
*/

// Realizo la conexión a la base de datos geslibros
$gesbank = new class_tabla_clientes();

// Obtengo todos los libros de la base de datos
$clientes = $gesbank->get_clientes();
