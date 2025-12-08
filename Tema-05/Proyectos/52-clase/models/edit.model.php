<?php

/*
    modelo: edit.model.php
    descripción: obtiene los datos del cliente a editar   

    Método GET:
            - id del cliente a editar
    
*/

// Obtener id del cliente
$cliente_id = $_GET['id'] ?? null;

// Validar id (omitir para simplificar)

// Conexión a la base de datos
$gesbank = new class_tabla_clientes();

// Obtener datos del cliente
$cliente = $gesbank->read($cliente_id);


