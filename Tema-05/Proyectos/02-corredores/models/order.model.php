<?php

/*
    modelo:  order.model.php
    descripción: Modelo para ordenar la tabla de corredores por diferentes campos.

    Ordernar por:
    - 1 : ordena por id ascendente
    - 2: ordena alfabeticamente ascendente
    - ...

    Parámetros:
    - $criterio : nº del campo por el que se ordena

*/
$t_orden = [ 
    1 => 'id ASC',
    2 => 'nombre ASC',
    3 => 'apellidos ASC',
    4 => 'ciudad ASC',
    5 => 'email ASC',
    6 => 'edad ASC',
    7 => 'categoria ASC',
    8 => 'club ASC'
];

// obtener criterio ordenación
$criterio = $_GET['criterio'] ?? null;

// Conectar base de datos
$conexion = new class_tabla_corredores();

// Ejecuto método order_by para obtener alumnos ordenados
$corredores = $conexion->order_by($criterio);

$notify = "Alumnos ordenados por el criterio $t_orden[$criterio]";


?>