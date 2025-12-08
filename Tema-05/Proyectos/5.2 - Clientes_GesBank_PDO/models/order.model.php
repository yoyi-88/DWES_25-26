<?php

/*
    modelo:  order.model.php
    descripción: Modelo para ordenar la tabla de alumnos por diferentes campos.

    Ordernar por:
    - 1 : ordena por id ascendente
    - 2: ordena alfabeticamente ascendente
    - ...

    Parámetros:
    - $criterio : nº del campo por el que se ordena

*/
$t_orden = [ 
    1 => 'id ASC',
    2 => 'alumno ASC',
    3 => 'email ASC',
    4 => 'nacionalidad ASC',
    5 => 'dni ASC',
    6 => 'edad ASC',
    7 => 'curso ASC'
];

// obtener criterio ordenación
$criterio = $_GET['criterio'] ?? null;

// Conectar base de datos
$conexion = new class_tabla_alumnos();

// Ejecuto método order_by para obtener alumnos ordenados
$alumnos = $conexion->order_by($criterio);

$notify = "Alumnos ordenados por el criterio $t_orden[$criterio]";


?>