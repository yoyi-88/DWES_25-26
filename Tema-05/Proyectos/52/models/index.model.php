<?php

/*
    modelo:  index.model.php
    descripción: obtiene los datos de los libros que luego se mostrarán en la vista
*/

// Realizo la conexión a la base de datos geslibros
$geslibros = new class_tabla_libros();

// Obtengo todos los libros de la base de datos
$libros = $geslibros->get_libros();

