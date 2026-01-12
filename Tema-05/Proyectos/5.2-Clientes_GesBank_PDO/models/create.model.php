<?php

/*
    modelo: craate.model.php
    descripción: añadir nuevo cliente a la tabla de cliente
    
    
*/

// Recoger datos del formulario
$apellidos = $_POST['apellidos'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$telefono = $_POST['telefono'] ?? null; 
$ciudad = $_POST['ciudad'] ?? null;
$dni = $_POST['dni'] ?? null;
$email = $_POST['email'] ?? null;

// Validar datos (omitir para simplificar)

// Crear objeto classs_cliente
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

// Añadir nuevo cliente
if ($gesbank->create($cliente)) {
    // Éxito
    $notify = "Cliente añadido correctamente.";
} else {
    // Error
    $error = "Error al añadir el cliente: ";
}

// Obtener lista actualizada de clientes
$clientes = $gesbank->get_clientes();



