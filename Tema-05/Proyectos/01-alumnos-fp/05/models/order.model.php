<?php

/*
    modelo:  order.model.php
    descripción: ordena la tabla de alumnos segun el criterio seleccionado

    ordenar por:
        1 - id acendente
        2 - alumno - orden alfabetico ascendente
        3 - email
        4 - nacionalidad
        5 - dni
        6 - edad
        7 - curso
*/

// Obtengo el criterio de ordenación
$criterio = $_GET['criterio'] ?? 1;

// Configuración base de datos
$conexion = new class_tabla_alumnos();

// Obtengo un objeto de la clase mysqli_result con los detalles de los alumnos
$alumnos = $conexion->order_by($criterio);



// }

?>