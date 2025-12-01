<?php

/*
    modelo: delete.model.php
    descripción: modelo para eliminar libro

    Método GET:

            - id: id del alumno
    
*/

// Obtener id libro a eliminar
$libro_id = $_GET['id'] ?? null;

// Validar id (omitir para simplificar)

// Conexión a la base de datos
$geslibros = new class_tabla_libros();

// Eliminar alumno
// Comprobar si se ha eliminado correctamente
if ($geslibros->delete($libro_id)) {
    // Éxito
    $notify = "Libro eliminado correctamente.";
} else {
    // Error
    $error = "Error al eliminar el alumno: ";
}   

// Cargo la lista de alumnos actualizada
$libros = $geslibros->get_libros();




