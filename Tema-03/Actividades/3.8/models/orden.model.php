<?php
/*
    Descripción: Actualiza los detalles de un libro en el array de libros
*/


// Leer el parámetro de ordenación
$orden = $_GET["orden"] ?? null;

$libros = get_tabla_libros();

$libros = ordenar($orden,  $libros);

// Forma sin función
// if ($orden) {
//     $array_orden = array_column($libros, $orden);

//     array_multisort($array_criterio, SORT_ASC, $libros);
// }
?>
