<?php

/*
    modelo: craate.model.php
    descripción: añadir nuevo alumno a la tabla de alumnos
    
    
*/

// Recoger datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$ciudad = $_POST['ciudad'];
$sexo = $_POST['sexo'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$email = $_POST['email'];
$dni = $_POST['dni'];
$categoria_id = $_POST['categoria_id'];
$club_id = $_POST['club_id'];


// Validar datos (omitir para simplificar)

// Crear objeto alumno
$corredor = new class_corredor(
    null,
    $nombre,
    $apellidos,
    $ciudad,
    $fecha_nacimiento,
    $sexo,
    $email,
    $dni,
    $categoria_id,
    $club_id
);

// Conexión a la base de datos
$conexion = new class_tabla_corredores('localhost', 'root', '', 'fp');

// Añadir nuevo alumno
if ($conexion->create($corredor)) {
    // Éxito
    $notify = "Corredor añadido correctamente.";
} else {
    // Error
    $error = "Error al añadir el corredor: ";
}

// Obtener lista actualizada de corredores
$corredores = $conexion->get_corredores();


