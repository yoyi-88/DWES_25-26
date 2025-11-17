<?php

/*
    Modelo principal del proyecto CRUD de articulos POO
*/

#simbolo moneda local
setlocale(LC_MONETARY, 'es_ES.UTF-8');

// Crea una instancia de la tabla de artículos 
$tabla_alumnos = new Class_tabla_alumnos();

// Cargar datos de ejemplo en la tabla de artículos
$tabla_alumnos->get_datos();

// Obtener los datos de los artículos
$alumnos = $tabla_alumnos->get_alumnos();


// Obtener los cursos disponibles
$cursos = Class_tabla_alumnos::get_curso();

// Obtener las asignaturas disponibles
$asignaturas = Class_tabla_alumnos::get_Asignaturas();




?>