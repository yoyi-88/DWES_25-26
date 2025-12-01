<?php

/*
    modelo: delete.model.php
    descripción: modelo para eliminar alumno

    Método GET:

            - id: id del alumno
    
*/

// Obtener id del alumno a eliminar
$corredor_id = $_GET['id'] ?? null;

// Validar id (omitir para simplificar)

// Conexión a la base de datos
$conexion = new class_tabla_corredores();

// Eliminar alumno
// Comprobar si se ha eliminado correctamente
if ($conexion->delete($corredor_id)) {
    // Éxito
    $notify = "Corredor eliminado correctamente.";
} else {
    // Error
    $error = "Error al eliminar el corredor: ";
}   

// Cargo la lista de alumnos actualizada
$corredores = $conexion->get_corredores();




