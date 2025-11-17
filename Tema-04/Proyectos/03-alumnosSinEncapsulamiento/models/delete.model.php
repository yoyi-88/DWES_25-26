<?php

/*
    Elimina un artículo de la tabla a partir de su id
    Parámetro GET:
    -ID: artículo a eliminar
*/

// Obtengo id del artículo
$id = $_GET['id'] ?? null;

// Obtener el array de objetos de la clase artículos

// Creo objeto de la clase tabla_articulos
$tabla_alumnos = new Class_tabla_alumnos();

// Cargar los datos
$tabla_alumnos->get_datos();

// Obtener el índice del array en el que se encuentra el objeto de la clase artículo
$indice = $tabla_alumnos->get_indice_from_id($id);

// Eliminar artículo del array mediante el método delete
$tabla_alumnos->delete($indice);

// Obtener la tabla articulos
$alumnos = $tabla_alumnos->get_alumnos();

// Obtener los cursos disponibles
$cursos = Class_tabla_alumnos::get_curso();

// Obtener las asignaturas disponibles
$asignaturas = Class_tabla_alumnos::get_Asignaturas();




?>