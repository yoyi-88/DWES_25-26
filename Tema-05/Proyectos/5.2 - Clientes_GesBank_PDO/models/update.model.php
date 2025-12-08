<?php

/*
    modelo: update.model.php
    descripción: actualiza los datos de un alumno en la base de datos
    
    Métod POST:
        
        - Los detalles del alumno
    
    Método GET:

        - id: id del alumno
    
*/

// Obtener id del alumno a actualizar
$alumno_id = $_GET['id'] ?? null;

// Recoger datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$fecha_nac = $_POST['fecha_nac'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$nacionalidad = $_POST['nacionalidad'];
$dni = $_POST['dni'];
$curso_id = $_POST['curso_id'];

// Validar datos (omitir para simplificar)

// Crear objeto alumno
$alumno = new class_alumno(
    null,
    $nombre,
    $apellidos,
    $email,
    $telefono,
    $nacionalidad,
    $dni,
    $fecha_nac,
    $curso_id
);

// Conexión a la base de datos
$conexion = new class_tabla_alumnos();

// Actualizar alumno
// y cmprobar si se ha actualizado correctamente
if ($conexion->update($alumno, $alumno_id)) {
    // Éxito
    $notify = "Alumno actualizado correctamente.";
} else {
    // Error
    $error = "Error al actualizar el alumno: ";
}

// Cargo la lista de alumnos actualizada
$alumnos = $conexion->get_alumnos();



