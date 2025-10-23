<?php
/*
    Elimina un libro del array libros segun su id
*/

// Obtener el id del libro a eliminar desde la URL
$id_eliminar = $_GET['id'] ?? null;

// Cargar el array de libros
$libros = get_tabla_libros();

// Obtener el índice del libro a eliminar partiendo del id
// Eliminar el libro del array si se encuentra

$indice = get_indice_libro_por_id($libros, $id_eliminar);
if ($indice !== null) {
    unset($libros[$indice]);
    // Reindexar el array para mantener los índices consecutivos
    $libros = array_values($libros);
}