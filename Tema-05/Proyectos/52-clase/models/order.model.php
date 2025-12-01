<?php

/*
    modelo:  order.model.php
    descripción: Modelo para ordenar la tabla libros por diferentes campos.

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
    2 => 'Título ASC',
    3 => 'Autor ASC',
    4 => 'Editorial ASC',
    5 => 'Géneros ASC',
    6 => 'Stock ASC',
    7 => 'Precio ASC'
];

// obtener criterio ordenación
$criterio = $_GET['criterio'] ?? null;

// Conectar base de datos geslibros
$geslibros = new class_tabla_libros();

// Ejecuto método order_by para obtener alumnos ordenados
$libros = $geslibros->order_by($criterio);

$notify = "Libros ordenados por el criterio $t_orden[$criterio]";


?>