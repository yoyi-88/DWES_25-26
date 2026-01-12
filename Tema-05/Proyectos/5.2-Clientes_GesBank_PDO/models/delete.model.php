<?php

/*
    modelo: delete.model.php
    descripción: modelo para eliminar cliente

    Método GET:

            - id: id del cliente
    
*/

// Obtener id cliente a eliminar
$cliente_id = $_GET['id'] ?? null;

// Validar id (omitir para simplificar)

// Conexión a la base de datos
$gesbank = new class_tabla_clientes();

// Eliminar cliente
// Comprobar si se ha eliminado correctamente
if ($gesbank->delete($cliente_id)) {
    // Éxito
    $notify = "Cliente eliminado correctamente.";
} else {
    // Error
    $error = "Error al eliminar el cliente: ";
}   

// Cargo la lista de clientes actualizada
$clientes = $gesbank->get_clientes();




