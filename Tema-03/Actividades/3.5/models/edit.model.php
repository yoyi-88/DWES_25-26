<?php
/*
    Edita un libro del array libros segun su id

    Método GET: 
        - id del libro a editar
        - ejemplo: edit.model.php?id=5
*/

// Obtener el id del libro a eliminar desde la URL
$id_editar = $_GET['id'] ?? null;

// Cargar el array de libros
$libros = get_tabla_libros();

// Obtener el índice del libro a eliminar partiendo del id
// Eliminar el libro del array si se encuentra

$indice = get_indice_libro_por_id($libros, $id_editar);

if ($indice !== null) {
    $libro = $libros[$indice];
} else {
    // Manejar el caso en el que el libro no se encuentra
    echo "ERROR: Libro no encontrado.";
    exit();
}