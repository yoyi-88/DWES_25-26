<?php
/*
    Modelo para mostrar un libro específico
*/
$id_mostrar = $_GET['id'] ?? null;

$libros = get_tabla_libros();

$indice = get_indice_libro_por_id($libros,$id_mostrar);

if ($indice !== null) {
    $libro = $libros[$indice];
} else {
    // Manejar el caso en que no se encuentra el libro
    echo 'Error. Libro no encontrado';
    exit();
}
?>