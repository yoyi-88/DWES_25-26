<?php

/*
    modelo:  order.model.php
    descripción: Modelo para ordenar la tabla clientes por diferentes campos.

    Ordernar por:
    - 1: ordena por id ascendente
    - 2: titulo ascendente
    - 3: autor ascendente
    - 4: editorial ascendente
    - 5: géneros ascendente
    - 6: stock ascendente
    - 7: precio ascendente
    

    Parámetros:
    - $criterio : nº del campo por el que se ordena

*/
$t_orden = [ 
    1 => 'id ASC',
    2 => 'Apellidos ASC',
    3 => 'Nombre ASC',
    4 => 'Teléfono ASC',
    5 => 'Ciudad ASC',
    6 => 'DNI ASC',
    7 => 'Email ASC'
];

// obtener criterio ordenación
$criterio = $_GET['criterio'] ?? null;

// Conectar base de datos geslibros
$gesbank = new class_tabla_clientes();

// Ejecuto método order_by para obtener alumnos ordenados
$clientes = $gesbank->order_by($criterio);

$notify = "Clientes ordenados por el criterio $t_orden[$criterio]";


?>