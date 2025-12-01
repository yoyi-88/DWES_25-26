<?php

/*
    modelo: edit.model.php
    descripción: obtiene los datos del libro a editar   

    Método GET:
            - id del libro a editar
    
*/

// Obtener id del libro
$cliente_id = $_GET['id'] ?? null;

// Validar id (omitir para simplificar)

// Conexión a la base de datos
$gesbank = new class_tabla_clientes();

// Obtener datos del libro
$cliente = $gesbank->read($cliente_id);


