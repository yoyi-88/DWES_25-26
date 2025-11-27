<?php

/*
    modelo: update.model.php
    descripción: actualiza los datos de un libro en la base de datos
    Métod POST:
        
        - Los detalles del libro
    
    Método GET:

        - id: id del libro
    
*/

// Obtener id del libro a actualizar
$libro_id = $_GET['id'] ?? null;

// Recoger datos del formulario
$titulo = $_POST['titulo'] ?? null;
$isbn = $_POST['isbn'] ?? null;
$precio_venta = $_POST['precio_venta'] ?? null;
$stock = $_POST['stock'] ?? null;
$fecha_edicion = $_POST['fecha_edicion'] ?? null;
$autor_id = $_POST['autor_id'] ?? null;
$editorial_id = $_POST['editorial_id'] ?? null;
$generos_id = $_POST['generos_id'] ?? null;

// Validar datos (omitir para simplificar)

// Crear objeto libro
$libro = new class_libro(
    null,
    $isbn,
    null,
    $titulo,
    $autor_id,
    $editorial_id,
    null,
    $precio_venta,
    $stock,
    null,
    null,
    $fecha_edicion

);

// Añado la propiedad generos_id al objeto libro
$libro->generos_id = $generos_id;   

// Conexión a la base de datos
$geslibros = new class_tabla_libros();

// Actualizar libro
// y cmprobar si se ha actualizado correctamente
if ($geslibros->update($libro, $libro_id)) {
    // Éxito
    $notify = "Libro actualizado correctamente.";
} else {
    // Error
    $error = "Error al actualizar el libro: ";
}

// Cargo la lista de libros actualizada
$libros = $geslibros->get_libros();



