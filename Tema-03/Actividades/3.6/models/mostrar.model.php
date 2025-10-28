<?php
/*
    Muestra un libro del array según su id
*/

// Obtenemos id del libro a mostrar
$id_mostrar = $_GET['id'] ?? null;

// Cargar el array de libros
$libros = get_tabla_libros();

// Obtener el índice del libro a eliminar partiendo del id
// Eliminar el libro del array si se encuentra

$indice = get_indice_libro_por_id($libros, $id_mostrar);

if ($indice !== null) {
    $libro = $libros[$indice];
} else {
    // Manejar el caso en el que el libro no se encuentra
    echo "ERROR: Libro no encontrado.";
    exit();
}
?>