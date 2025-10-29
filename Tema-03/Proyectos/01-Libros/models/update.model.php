<?php
/*
    Descripción: Actualiza los detalles de un libro en el array de libros
*/

// Obtenemos el ID del libro a editar desde el método GET
$id_editar = $_GET['id'] ?? null;

// Extraemos los datos del formulario enviado por POST
$titulo = $_POST['titulo'] ?? null;
$autor = $_POST['autor'] ?? null;
$editorial = $_POST['editorial'] ?? null;
$genero = $_POST['genero'] ?? null;
$precio = $_POST['precio'] ?? null;

// Cargamos el array de libros existente
$libros = get_tabla_libros();

// Obtenemos el índice del libro a editar
$indice_libro = get_indice_libro_por_id($libros, $id_editar);

// Creo un array asociativo con los nuevos datos del libro
$libro_actualizado = [
    'id' => $id_editar,
    'titulo' => $titulo,
    'autor' => $autor,
    'editorial' => $editorial,
    'genero' => $genero,
    'precio' => (float)$precio
];

// Actualizamos el libro en el array de libros
$libros[$indice_libro] = $libro_actualizado;



?>
