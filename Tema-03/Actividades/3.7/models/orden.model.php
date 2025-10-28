<?php
/*
    Descripción: Actualiza los detalles de un libro en el array de libros
*/


// Leer el parámetro de ordenación
$orden = $_GET["orden"] ?? null;

$libros = get_tabla_libros();

$libros = ordenar( $orden,  $libros);


?>
