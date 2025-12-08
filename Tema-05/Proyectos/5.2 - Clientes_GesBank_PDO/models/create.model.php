<?php

/*
    modelo: craate.model.php
    descripción: añadir nuevo alumno a la tabla de alumnos
    
    
*/

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
$conexion = new class_tabla_alumnos('localhost', 'root', '', 'fp');

// Añadir nuevo alumno
if ($conexion->create($alumno)) {
    // Éxito
    $notify = "Alumno añadido correctamente.";
} else {
    // Error
    $error = "Error al añadir el alumno: ";
}

// Obtener lista actualizada de alumnos
$alumnos = $conexion->get_alumnos();



