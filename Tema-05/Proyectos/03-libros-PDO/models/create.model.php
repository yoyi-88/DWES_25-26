<?php

/*
    modelo: craate.model.php
    descripción: añadir nuevo alumno a la tabla de alumnos
    
    
*/

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

// Crear objeto class_libro
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

// Conexión a la base de datos
$geslibros = new class_tabla_libros();

// Añadir nuevo alumno
    if ($geslibros->create($libro)) {
    // Éxito
    $notify = "Libro añadido correctamente.";
} else {
    // Error
    $error = "Error al añadir el libro: ";
}

// Obtener lista actualizada de alumnos
$libros = $geslibros->get_libros();



