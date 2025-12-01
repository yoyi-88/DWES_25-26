<?php

/*
    modelo: craate.model.php
    descripción: añadir nuevo alumno a la tabla de alumnos
    
    
*/

// Recoger datos del formulario
$apellidos = $_POST['apellidos'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$telefono = $_POST['telefono'] ?? null; 
$ciudad = $_POST['ciudad'] ?? null;
$dni = $_POST['dni'] ?? null;
$email = $_POST['email'] ?? null;

// Validar datos (omitir para simplificar)

// Crear objeto classs_libro
$cliente = new class_cliente(
    null,
    $apellidos,
    $nombre,
    $telefono,
    $ciudad,
    $dni,
    $email
);

// Conexión a la base de datos
$gesbank = new class_tabla_clientes();

// Añadir nuevo alumno
if ($gesbank->create($cliente)) {
    // Éxito
    $notify = "Cliente añadido correctamente.";
} else {
    // Error
    $error = "Error al añadir el cliente: ";
}

// Obtener lista actualizada de alumnos
$clientes = $gesbank->get_clientes();



