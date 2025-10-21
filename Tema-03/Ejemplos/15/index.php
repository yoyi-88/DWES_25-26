<?php
/*
Descripción: Librería con funciones reutilizables
*/

include 'libs/function.php';

$alumno = [
    "nombre" => "Juan",
    "edad" => 20,
    "curso" => "Programación",
    "apellidos" => "Pérez"
];

mostrar_alumno($alumno);

$alumno = [
    "nombre" => "Juan",
    "curso" => "Programación",
    "apellidos" => "Pérez"
];

mostrar_alumno($alumno);

?>