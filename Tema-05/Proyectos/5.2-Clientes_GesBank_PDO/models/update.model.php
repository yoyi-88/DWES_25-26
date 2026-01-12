<?php

/*
    modelo: update.model.php
    descripción: actualiza los datos de un cliente en la base de datos
    a partir de los datos recibidos del formulario update.view.php
    
    Métod POST:
        
        - Los detalles del cliente:
    
    Método GET:

        - id: id del cliente
    
*/

// Obtener id del cliente a actualizar
$cliente_id = $_GET['id'] ?? null;

// Obtener datos del formulario
$apellidos = $_POST['apellidos'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$telefono = $_POST['telefono'] ?? null;
$ciudad = $_POST['ciudad'] ?? null;
$dni = $_POST['dni'] ?? null;
$email = $_POST['email'] ?? null;


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

// Actualizar cliente
// y comprobar si se ha actualizado correctamente
if ($gesbank->update($cliente, $cliente_id)) {
    // Éxito
    $notify = "Cliente actualizado correctamente.";
} else {
    // Error
    $error = "Error al actualizar el cliente: ";
}

// Obtener lista actualizada de clientes
$clientes = $gesbank->get_clientes();



