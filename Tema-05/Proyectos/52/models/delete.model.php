<?php

/*
    modelo: delete.model.php
    descripción: modelo para eliminar alumno

    Método GET:

            - id: id del alumno
    
*/

// Obtener id del alumno a eliminar
$alumno_id = $_GET['id'] ?? null;

// Validar id (omitir para simplificar)

// Conexión a la base de datos
$conexion = new class_tabla_alumnos();

// Eliminar alumno
// Comprobar si se ha eliminado correctamente
if ($conexion->delete($alumno_id)) {
    // Éxito
    $notify = "Alumno eliminado correctamente.";
} else {
    // Error
    $error = "Error al eliminar el alumno: ";
}   

// Cargo la lista de alumnos actualizada
$alumnos = $conexion->get_alumnos();




